<?php

namespace App\Console\Commands;

use App\Models\AppointmentMl;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;
use Google\Client;
use GuzzleHttp\Client as GL;
use Google\Service\Calendar;
use Google_Service_Calendar_Event;
use App\Models\Professional;
use Carbon\Carbon;

class ApiMedelinkCalendar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ln:MedelinkCalendar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Api Medelink witn Google Calendar';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->token = "WzpwZkzjncn1nyfvYx3VovEzTvpB2YSie4YPfvf1.8sggWtpBM3vzmAuE6aYAAmRYiAwxbXNIaM16oJ30";
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $professionals = Professional::where('id',2)->get();

        foreach($professionals as $professional){
            if(isset($professional->professional_calendar)){
                $this->store($professional);
            }
        }
    }

    public function store($professional){
        $this->getClient();
        $client = new \GuzzleHttp\Client();
        $query_string   = '?q={"rut":{"eq":"'.$professional->user->rut.'"}}';
        $url = 'https://api.medilink.healthatom.com/api/v1/profesionales/';
        $url = $url."".$query_string;

        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $this->token
            ]
        ]);
        
        
        $professional_api = json_decode($response->getBody())->data[0];

        $query_string   = '?q={"fecha":{"gt":"2022-12-29"}}';
        $url = 'https://api.medilink.healthatom.com/api/v1/profesionales/'.$professional_api->id.'/citas';
        $url = $url."".$query_string;

        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $this->token
            ]
        ]);

        $allAppointments = [];
        $appointments = json_decode($response->getBody());
        $allAppointments[] = $appointments->data;
        
        while(isset($appointments->links->next)){
            $response = $client->request('GET', $appointments->links->next, [
                'headers'  => [
                    'Authorization' => 'Token ' . $this->token
                ]
            ]);
            $appointments = json_decode($response->getBody());
            $allAppointments[] = $appointments->data;
            
        }
        $allAppointments = array_merge(...$allAppointments);
        
        // $appointments = json_decode($response->getBody())->data;
        // $allAppointments = array_slice($allAppointments, 0, 10, false);

        $this->info(count($allAppointments));
        foreach($allAppointments as $appointment){

            if(AppointmentMl::where('Tratamiento_Nr',$appointment->id_atencion)->where('professional_calendar','not like','0')->count() > 0)
            {
                $actual = AppointmentMl::where('Tratamiento_Nr',$appointment->id_atencion)->where('professional_calendar','not like','0')->first();
                $this->info($appointment->id_atencion);
                if(in_array($appointment->estado_cita,['Anulado','Cambio de fecha','Anulado por sesiones en conflicto','Anulado vía validación'])){
                    try {
                        $client = $this->getClient();
                        $service = new Calendar($client);
                        $service->events->delete($professional->professional_calendar,$actual->professional_calendar);
                        $actual->professional_calendar = 0;
                        $actual->save();
                    } catch (Exception $e) {
                        echo $client, "\n";
                    }
                } else {
                    $this->info('este safo');
                }
                continue;
            } 

            if(in_array($appointment->estado_cita,['Anulado','Cambio de fecha','Anulado por sesiones en conflicto','Anulado vía validación'])){
                continue;
            }

            $client = $this->getClient();
            $service = new Calendar($client);
            $start = Carbon::parse($appointment->fecha)->format('Y-m-d')."T".$appointment->hora_inicio;
            $end = \Carbon\Carbon::parse($appointment->fecha)->format('Y-m-d')."T".$appointment->hora_fin;
            // Agregar logica de ultima sesión
            $event = new Google_Service_Calendar_Event(array(
                'summary' => 'Atención a '.ucwords(strtolower($appointment->nombre_paciente)),
                'location' => 'San Pascual 736',
                'description' => "Paciente: ".ucwords(strtolower($appointment->nombre_paciente))."\nCon: ".$appointment->estado_cita." ". $appointment->id_atencion,
                'start' => array(
                    'dateTime' => $start,
                    'timeZone' => 'America/Santiago',
                  ),
                'sendUpdates' => 'none',
                'end' => array(
                    'dateTime' => $end,
                    'timeZone' => 'America/Santiago',
                  ),
                'attendees' => array(
                    array('email' => 'cristobalugarte6@gmail.com'),
                    // array('email' => '".$professional_api->email."'),
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
            $event = $service->events->insert($professional->professional_calendar, $event);
            
            $this->info('Creado:'.ucwords(strtolower($appointment->nombre_paciente)));

            $client = new \GuzzleHttp\Client();

            $url = 'https://api.medilink.healthatom.com/api/v1/pacientes/'.$appointment->id_paciente;

            $response = $client->request('GET', $url, [
                'headers'  => [
                    'Authorization' => 'Token ' . $this->token
                ]
            ]);

            $patient = json_decode($response->getBody())->data;
            // $this->info(var_dump($appointment));
            $appointmentml = AppointmentMl::updateOrCreate(
                [
                    'Tratamiento_Nr' => $appointment->id_atencion,
                    'Rut_Paciente' => $patient->rut,
                    'Fecha' => $appointment->fecha ,
                ],
                [
                    'Estado' => $appointment->estado_cita,
                    'Fecha' => $appointment->fecha ,
                    'Fecha_Generación' => $appointment->fecha_actualizacion ,
                    'Hora_inicio' => $appointment->hora_inicio ,
                    'Hora_termino' => $appointment->hora_fin ,
                    'Tratamiento_Nr' => $appointment->id_atencion ,
                    'Profesional' => $appointment->nombre_profesional ,
                    'Rut_Paciente' => $patient->rut ,
                    'Nombre_paciente' => $patient->rut ,
                    'Apellidos_paciente' => $patient->nombre ,
                    'Mail' => $patient->apellidos ,
                    'Celular' => $patient->celular ,
                    'Convenio' => 0,
                    'Sucursal' => $appointment->nombre_sucursal ,
                    'professional_calendar' => $event->id,
                ]
            );
        }

    }

    public function getClient()
    {
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
