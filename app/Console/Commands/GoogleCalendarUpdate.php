<?php

namespace App\Console\Commands;

use App\Models\AppointmentMl;
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
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->getClient();
        // $this->superdelete();
        // $this->superStore('Alonso Niklitschek Sanhueza','c_1hkcfsu55r04nisn1b087b4f5g@group.calendar.google.com','alonso7@gmail.com');
        // $this->superUpdate('Alonso Niklitschek Sanhueza','c_1hkcfsu55r04nisn1b087b4f5g@group.calendar.google.com');
        $this->superStore('Jaime Pantoja Rodriguez','c_1dhlgacu9kmin254ievq27cp7s@group.calendar.google.com','docencia@justbetter.cl');
        $this->superUpdate('Jaime Pantoja Rodriguez','c_1dhlgacu9kmin254ievq27cp7s@group.calendar.google.com');
    }

    public function superStore($professional,$calendarId,$email){
        $appointments = AppointmentMl::nextProfessional($professional)->get();
        foreach ($appointments as $key => $appointment) {
            $client = $this->getClient();
            $service = new Calendar($client);
            $start = \Carbon\Carbon::parse($appointment->Fecha)->format('Y-m-d')."T".$appointment->Hora_inicio;
            $end = \Carbon\Carbon::parse($appointment->Fecha)->format('Y-m-d')."T".$appointment->Hora_termino;
            $event = new Google_Service_Calendar_Event(array(
              'summary' => 'Atención a '.$appointment->Nombre_paciente." ".$appointment->Apellidos_paciente,
              'location' => 'San Pascual 736',
              'description' => $appointment->Nombre_paciente." ".$appointment->Apellidos_paciente."\n Estado: ".$appointment->Estado."\n Con: ".$appointment->Profesional,
              'start' => array(
                'dateTime' => $start,
                'timeZone' => 'America/Santiago',
              ),
              'sendNotifications' => true,
              'sendUpdates' => 'all',
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
            $appointment->professional_calendar = $event->id;
            // $service = new Calendar($client);
            // $service->events->delete($calendarId, $event->id);
            $this->info('Creado:'.$appointment->Nombre_paciente.' '.$appointment->Apellidos_paciente);
            $appointment->save();
        }
        $this->info('---');
        return $appointments;
    }

    public function superUpdate($professional,$calendarId){
        $appointments = AppointmentMl::calendarAppointments($professional)->get();
        $client = $this->getClient();
        foreach ($appointments as $key => $appointment) {
            if(!in_array($appointment->Estado, ['Cambio de fecha','Cambio de Fecha','Anulado'])){
                continue;
            }
            $service = new Calendar($client);
            $service->events->delete($calendarId, $appointment->professional_calendar);
            $this->info('Borrar:'.$appointment->Nombre_paciente.' '.$appointment->Apellidos_paciente);
            $appointment->professional_calendar = 0;
            $appointment->save();
        }
        return $appointments;
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
