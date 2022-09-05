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
        $this->superdelete('Alonso Niklitschek Sanhueza','c_1hkcfsu55r04nisn1b087b4f5g@group.calendar.google.com');
        // $this->superdelete('Jaime Pantoja Rodriguez','c_1dhlgacu9kmin254ievq27cp7s@group.calendar.google.com');
    }


    public function superdelete($professional,$calendarId){
        $appointments = AppointmentMl::calendarAppointments($professional)->get();
        $client = $this->getClient();
        foreach ($appointments as $key => $appointment) {
            try {
                $service = new Calendar($client);
                $service->events->delete($calendarId, $appointment->professional_calendar);
                $appointment->professional_calendar = 0;
                $appointment->save();
            } catch (Exception $e) {
                echo $clientt, "\n";
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
