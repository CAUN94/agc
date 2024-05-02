<?php

namespace App\Console\Commands;

use App\Models\AppointmentMl;
use App\Models\UserMl;
use App\Models\Professional;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;
use Google\Client;
use Google\Service\Calendar;
use Google_Service_Calendar_Event;

class GoogleCalendarUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ln:googleCalendarUpdate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Google Calendar Update';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->token = config('app.medilink');
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->getClient();

        $professionals = Professional::google_id();
        foreach($professionals as $professional){
            // info profesional->description ' '  $professional->user->email
            $this->info($professional->description.' '.$professional->user->email);
            $this->listCalendar($professional->google_id);
            // $this->addcalendar($professional->id);
            // $this->info($professional->google_id);
            $this->info('Esperando 3 minutos'); 
            sleep(60);
        }        
    }

    public function addcalendar($id){
        $professional = Professional::find($id);
        $calendarId = $professional->google_id;
        $email = $professional->user->email;
  
        $client = new \GuzzleHttp\Client();
        $url = 'https://api.medilink.healthatom.com/api/v1/profesionales/?q={"rut":{"eq":"'.$professional->user->rut.'"}}';
        
        $rut = $professional->user->rut;

        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $this->token
            ]
        ]);
        
        $professional = json_decode($response->getBody())->data[0];

        if($rut == '16608122-k'){
          $professional = json_decode($response->getBody())->data[1];
        }
  
        // yesterday date
        $yesterday = \Carbon\Carbon::now()->subDays(1)->format('Y-m-d');

        $url = $professional->links[1]->href.'?q={"fecha":{"gt":"'.$yesterday.'"}}';
        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $this->token
            ]
        ]);
  
        $professional_date = json_decode($response->getBody());
        
        $allprofessional_date = [];
        $professional_date = json_decode($response->getBody());
        $allprofessional_date[] = $professional_date->data;
        while(isset($professional_date->links->next)){
          $response = $client->request('GET', $professional_date->links->next, [
              'headers'  => [
                  'Authorization' => 'Token ' . $this->token
              ]
          ]);
          $professional_date = json_decode($response->getBody());
          $allprofessional_date[] = $professional_date->data;
      }
  
      $allprofessional_date = array_merge(...$allprofessional_date);
      $client = $this->getClient();
      foreach($allprofessional_date as $appointment){
        if(in_array($appointment->estado_cita, ['Cambio de fecha','Anulado vía validación','No asiste','Anulado'])){
            continue;
        }
        $service = new Calendar($client);
        $start = \Carbon\Carbon::parse($appointment->fecha)->format('Y-m-d')."T".$appointment->hora_inicio;
        $end = \Carbon\Carbon::parse($appointment->fecha)->format('Y-m-d')."T".$appointment->hora_fin;
        $event = new Google_Service_Calendar_Event(array(
          'summary' => 'Atención a '.$appointment->nombre_paciente,
          'location' => 'San Pascual 309',
          'description' => "Paciente: ".$appointment->nombre_paciente."\nCon: ".$appointment->nombre_profesional,
          'start' => array(
            'dateTime' => $start,
            'timeZone' => 'America/Santiago',
          ),
          'sendNotifications' => false,
          'sendUpdates' => 'none',
          'end' => array(
            'dateTime' => $end,
            'timeZone' => 'America/Santiago',
          ),
          'attendees' => array(
            array('email' => $email),
            array('email' => 'you@justbetter.cl'),
            // array('email' => 'Docencia@justbetter.cl'),
            // array('email' => 'cugarte@guiasyscoutschile.cl'),
            // array('email' => 'iver@justbetter.cl'),
            // array('email' => 'pablo@justbetter.cl'),
          ),
          'reminders' => array(
            'useDefault' => False,
            'overrides' => array(
              array('method' => 'email', 'minutes' => 24 * 60),
              array('method' => 'popup', 'minutes' => 10),
            ),
          ),
        ));
  
        $event = $service->events->insert($calendarId, $event);
        $this->info('Event created: '.$event->getSummary());
      }
  
      return $allprofessional_date;
    }

    public function listCalendar($calendarId){
        // $calendarId = $calendar;
        $client = $this->getClient();
        $service = new Calendar($client);
        // $calendarList = $service->calendarList->listCalendarList();
        // $calendarListEntry = $service->calendarList->get($calendarId);
    
        
        $events = $service->events->listEvents($calendarId);
        while(true) {
          foreach ($events->getItems() as $event) {
            // get event date
            $start = $event->getStart()->dateTime;
            $this->info($start);
            // if event date is less than today
            if($start < date('Y-m-d H:i:s')){
              continue;
            }
            $this->info("Borrada ".$event->getSummary());
            $service->events->delete($calendarId, $event->getID());
          }
          $pageToken = $events->getNextPageToken();
          if ($pageToken) {
            $optParams = array('pageToken' => $pageToken);
            $events = $service->events->listEvents($calendarId, $optParams);
          } else {
            break;
          }
        }
      }

    public function getClient(){
        $client = new Client();        
        $client->setApplicationName('Google Calendar API PHP Quickstart');
        $client->setScopes("https://www.googleapis.com/auth/calendar");
        $client->setAuthConfig(public_path('credentials.json'));
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        // Load previously authorized token from a file, if it exists.
        // The file token.json stores the user's access and refresh tokens, and is
        // created automatically when the authorization flow completes for the first
        // time.
        $tokenPath = public_path('token.json');
        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            $client->setAccessToken($accessToken);
        }

        // If there is no previous token or it's expired.
        if ($client->isAccessTokenExpired()) {
            // Refresh the token if possible, else fetch a new one.
            if ($client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            } else {
                // Request authorization from the user.
                $authUrl = $client->createAuthUrl();
                printf("Open the following link in your browser:\n%s\n", $authUrl);
                print 'Enter verification code: ';
                $authCode = trim(fgets(STDIN));

                // Exchange authorization code for an access token.
                $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
                $client->setAccessToken($accessToken);

                // Check to see if there was an error.
                if (array_key_exists('error', $accessToken)) {
                    throw new Exception(join(', ', $accessToken));
                }
            }
            // Save the token to a file.
            if (!file_exists(dirname($tokenPath))) {
                mkdir(dirname($tokenPath), 0700, true);
            }
            file_put_contents($tokenPath, json_encode($client->getAccessToken()));
        }
        return $client;
    }
}
