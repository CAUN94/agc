<?php

namespace App\Http\Controllers;

use App\Models\AppointmentMl;
use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;
use Google\Client;
use Google\Service\Calendar;
use Illuminate\Support\Facades\Auth;
use Google_Service_Calendar_Event;
use Session as FlashSession;

class CalendarController extends Controller
{
    public function index(){
        $client = $this->getClient();
        $service = new Calendar($client);
        try{
            $calendarId = 'c_1hkcfsu55r04nisn1b087b4f5g@group.calendar.google.com';
            $optParams = array(
                'maxResults' => 1000,
                'orderBy' => 'startTime',
                'singleEvents' => true,
                'timeMin' => date('c'),
            );
            $results = $service->events->listEvents($calendarId, $optParams);
            $events = $results->getItems();

            if (empty($events)) {
                return 0;
            } else {
                return $events;
            }
        }
        catch(Exception $e) {
            // TODO(developer) - handle error appropriately
            return False;
        }


    }

    public function create(){

    }

    public function store($id){
        $client = $this->getClient();
        $service = new Calendar($client);
        $appointment = AppointmentMl::findorfail($id);
        if(Auth::user()->rut != $appointment->Rut_Paciente){
            FlashSession::flash('primary', "Error");
        } else {
            $start = \Carbon\Carbon::parse($appointment->Fecha)->format('Y-m-d')."T".$appointment->Hora_inicio;
            $end = \Carbon\Carbon::parse($appointment->Fecha)->format('Y-m-d')."T".$appointment->Hora_termino;
            $event = new Google_Service_Calendar_Event(array(
              'summary' => 'Atención con en You Just Better',
              'location' => 'San Pascual 736',
              'description' => 'Atención con '.$appointment->Profesional .'\n Estado: ',
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
                array('email' => Auth::user()->email)
              ),
              'reminders' => array(
                'useDefault' => False,
                'overrides' => array(
                  array('method' => 'email', 'minutes' => 24 * 60),
                  array('method' => 'popup', 'minutes' => 10),
                ),
              ),
            ));

            $calendarId = 'c_1dhlgacu9kmin254ievq27cp7s@group.calendar.google.com';
            $event = $service->events->insert($calendarId, $event);
            FlashSession::flash('primary', 'Agendado');
            $appointment->professional_calendar = !$appointment->professional_calendar;
            $appointment->save();
        }

        return redirect('/calendar');
    }

    public function superStore(){
        $appointments = AppointmentMl::nextProfessional('Hola')->get();
        foreach ($appointments as $key => $appointment) {
            $client = $this->getClient();
            $service = new Calendar($client);
            $start = \Carbon\Carbon::parse($appointment->Fecha)->format('Y-m-d')."T".$appointment->Hora_inicio;
            $end = \Carbon\Carbon::parse($appointment->Fecha)->format('Y-m-d')."T".$appointment->Hora_termino;
            $event = new Google_Service_Calendar_Event(array(
              'summary' => 'Atención a '.$appointment->Nombre_paciente,
              'location' => 'San Pascual 309',
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
                array('email' => 'alonso7@gmail.com'),
                array('email' => 'you@justbetter.cl'),
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
            $calendarId = 'c_1hkcfsu55r04nisn1b087b4f5g@group.calendar.google.com';
            $event = $service->events->insert($calendarId, $event);
            $appointment->professional_calendar = $event->id;
            // $service = new Calendar($client);
            // $service->events->delete($calendarId, $event->id);
            $appointment->save();
        }
        return $appointments;
    }

    public function superdelete(){
        $appointments = AppointmentMl::calendarAppointments()->get();
        $client = $this->getClient();
        $calendarId = 'c_1hkcfsu55r04nisn1b087b4f5g@group.calendar.google.com';
        foreach ($appointments as $key => $appointment) {
            // if(!in_array($appointment->Estado, ['Cambio de fecha','Anulado'])){
            //     continue;
            // }
            $service = new Calendar($client);
            $service->events->delete($calendarId, $appointment->professional_calendar);
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
