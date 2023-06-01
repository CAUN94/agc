<?php

namespace App\Console\Commands;

use App\Models\AppointmentMl;
use App\Models\UserMl;
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
        // $this->superStore('Alonso Niklitschek Sanhueza','c_0f1ec4cb6ddb69027c0f6e89110fb1708a9613a28be7efc2165475004be2398d@group.calendar.google.com','alonso@justbetter.cl');
        
        // $this->superUpdate('Alonso Niklitschek Sanhueza','c_0f1ec4cb6ddb69027c0f6e89110fb1708a9613a28be7efc2165475004be2398d@group.calendar.google.com');
        // $this->deleteRepeats('Alonso Niklitschek Sanhueza','c_0f1ec4cb6ddb69027c0f6e89110fb1708a9613a28be7efc2165475004be2398d@group.calendar.google.com');

        // $this->superStore('Jaime  Pantoja Rodriguez','c_a5e903612c38cf636cddc1ad9f5d85f5cfc58fc2350ab902696cef768930fe27@group.calendar.google.com','docencia@justbetter.cl');
        // $this->superUpdate('Jaime  Pantoja Rodriguez','c_a5e903612c38cf636cddc1ad9f5d85f5cfc58fc2350ab902696cef768930fe27@group.calendar.google.com');
        // $this->deleteRepeats('Jaime  Pantoja Rodriguez','c_a5e903612c38cf636cddc1ad9f5d85f5cfc58fc2350ab902696cef768930fe27@group.calendar.google.com');

        // $this->superStore('Daniella Vivallo Vera','c_70cc091402f167e8244d73d4a32ad15d0e21368ead3e7145eede9f69ce57b019@group.calendar.google.com','clinica@justbetter.cl');
        // $this->superUpdate('Daniella Vivallo Vera','c_70cc091402f167e8244d73d4a32ad15d0e21368ead3e7145eede9f69ce57b019@group.calendar.google.com');
        // $this->deleteRepeats('Daniella Vivallo Vera','c_70cc091402f167e8244d73d4a32ad15d0e21368ead3e7145eede9f69ce57b019@group.calendar.google.com');

        // $this->superStore('Manuel Silva Ávila','c_cdc49b01298351d88c6468980988cf46b288841aeabf875ebffaed4a06b45530@group.calendar.google.com','Kine.Manuel.silva@gmail.com');
        // $this->superUpdate('Manuel Silva Ávila','c_cdc49b01298351d88c6468980988cf46b288841aeabf875ebffaed4a06b45530@group.calendar.google.com');
        // $this->deleteRepeats('Manuel Silva Ávila','c_cdc49b01298351d88c6468980988cf46b288841aeabf875ebffaed4a06b45530@group.calendar.google.com','Kine.Manuel.silva@gmail.com');

        // $this->superStore('Camila Valentini Rojas','c_774a51d77aa92fff83bc27c54aea7caa6214d02b32415d38e38833e2bf6c88ea@group.calendar.google.com','cvalentini@uc.cl');
        // $this->superUpdate('Camila Valentini Rojas','c_774a51d77aa92fff83bc27c54aea7caa6214d02b32415d38e38833e2bf6c88ea@group.calendar.google.com');
        // $this->deleteRepeats('Camila Valentini Rojas','c_774a51d77aa92fff83bc27c54aea7caa6214d02b32415d38e38833e2bf6c88ea@group.calendar.google.com');

        // $this->superStore('Nicole Cedeño Wolf ','c_50e57474f2f9941c93de2de40212b24f6a44a65d72a40399bbab8cfcb1221fa2@group.calendar.google.com','Niccole.cedeno@lanek.cl');
        // $this->superUpdate('Nicole Cedeño Wolf ','c_50e57474f2f9941c93de2de40212b24f6a44a65d72a40399bbab8cfcb1221fa2@group.calendar.google.com');
        // $this->deleteRepeats('Nicole Cedeño Wolf ','c_50e57474f2f9941c93de2de40212b24f6a44a65d72a40399bbab8cfcb1221fa2@group.calendar.google.com');

        $this->superStore('Constanza Ahumada Huerta','c_5bd69a1568b6d8319f6bac34e6eb66a336de83458e7a206645ac43c265f93104@group.calendar.google.com','Coniahum@gmail.com');
        $this->superUpdate('Constanza Ahumada Huerta','c_5bd69a1568b6d8319f6bac34e6eb66a336de83458e7a206645ac43c265f93104@group.calendar.google.com');
        $this->deleteRepeats('Constanza Ahumada Huerta','c_5bd69a1568b6d8319f6bac34e6eb66a336de83458e7a206645ac43c265f93104@group.calendar.google.com');
    }

    public function superStore($professional,$calendarId,$email){
        $this->info($professional);
        $appointments = AppointmentMl::nextProfessional($professional)->get();
        foreach ($appointments as $key => $appointment) {
            $client = $this->getClient();
            $service = new Calendar($client);
            $start = \Carbon\Carbon::parse($appointment->Fecha)->format('Y-m-d')."T".$appointment->Hora_inicio;
            $end = \Carbon\Carbon::parse($appointment->Fecha)->format('Y-m-d')."T".$appointment->Hora_termino;
            $last = AppointmentMl::lastAppointment($appointment->id);
            $lastDate = \Carbon\Carbon::parse($last->Fecha)->format('Y-m-d');
            $lastProfessional = $last->Profesional;
            $event = new Google_Service_Calendar_Event(array(
              'summary' => 'Atención a '.$appointment->Nombre_paciente." ".$appointment->Apellidos_paciente,
              'location' => 'San Pascual 736',
              'description' => "Paciente: ".$appointment->Nombre_paciente." ".$appointment->Apellidos_paciente."\nCon: ".$appointment->Profesional."\nUltima Atención: ".$lastDate." con ".$lastProfessional,
              'start' => array(
                'dateTime' => $start,
                'timeZone' => 'America/Santiago',
              ),
              'sendNotifications' => false,
              'sendUpdates' => 'externalOnly',
              'end' => array(
                'dateTime' => $end,
                'timeZone' => 'America/Santiago',
              ),
              'attendees' => array(
                array('email' => 'cristobalugarte6@gmail.com'),
                // array('email' => 'you@justbetter.cl'),
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
            $this->info('Creado:'.$appointment->Nombre_paciente.' '.$appointment->Apellidos_paciente);
            $appointment->save();
        }
        return $appointments;
    }

    public function superUpdate($professional,$calendarId){
        $appointments = AppointmentMl::calendarAppointments($professional)->get();
        $client = $this->getClient();
        foreach ($appointments as $key => $appointment) {
            if(!in_array($appointment->Estado, ['Cambio de fecha','Anulado','Anulado vía validación','No asiste'])){
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

    public function deleteRepeats($professional,$calendarId){
        $results = AppointmentMl::allCalendarAppointments($professional)->get(['id'])->toArray();
        $client = $this->getClient();
        foreach($results as $result){
            $this->info($result->id);
            $appointment = AppointmentMl::find($result->id);
            $service = new Calendar($client);
            $service->events->delete($calendarId, $appointment->professional_calendar);
            $this->info('Borrar:'.$appointment->Nombre_paciente.' '.$appointment->Apellidos_paciente);
            $appointment->professional_calendar = 0;
            $appointment->save();
            $appointment->delete();
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
