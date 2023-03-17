<?php

namespace App\Console\Commands;

use App\Models\AppointmentMl;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;
use Google\Client;
use Google\Service\Calendar;
use Google_Service_Calendar_Event;

class GoogleCalendarDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ln:googleCalendarDelete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Google Calendar Delete';

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

        $this->superdelete('Alonso Niklitschek Sanhueza','c_0f1ec4cb6ddb69027c0f6e89110fb1708a9613a28be7efc2165475004be2398d@group.calendar.google.com');
        $this->superdelete('Jaime  Pantoja Rodriguez','c_a5e903612c38cf636cddc1ad9f5d85f5cfc58fc2350ab902696cef768930fe27@group.calendar.google.com');
        $this->superdelete('Daniella Vivallo Vera','c_70cc091402f167e8244d73d4a32ad15d0e21368ead3e7145eede9f69ce57b019@group.calendar.google.com');
        $this->superdelete('Manuel Silva Ávila','c_cdc49b01298351d88c6468980988cf46b288841aeabf875ebffaed4a06b45530@group.calendar.google.com');
        $this->superdelete('Camila Valentini Rojas','c_774a51d77aa92fff83bc27c54aea7caa6214d02b32415d38e38833e2bf6c88ea@group.calendar.google.com');
        $this->superdelete('Nicole Cedeño Wolf ','c_50e57474f2f9941c93de2de40212b24f6a44a65d72a40399bbab8cfcb1221fa2@group.calendar.google.com');
        $this->superdelete('Constanza Ahumada Huerta','c_5bd69a1568b6d8319f6bac34e6eb66a336de83458e7a206645ac43c265f93104@group.calendar.google.com');


    }

    public function superdelete($professional,$calendarId){
        $appointments = AppointmentMl::calendarAppointments($professional)->get();
        $client = $this->getClient();
        foreach ($appointments as $key => $appointment) {
            $this->info($appointment->professional_calendar);
            try {
                $service = new Calendar($client);
                $service->events->delete($calendarId, $appointment->professional_calendar);
                $appointment->professional_calendar = 0;
                $appointment->save();
            } catch (Exception $e) {
                echo $client, "\n";
            }

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
