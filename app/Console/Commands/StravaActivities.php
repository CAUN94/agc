<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\StravaUser;
use App\Models\User;
use Carbon\Carbon;
use App\Models\StravaActivities as SA;
use Strava;

class StravaActivities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ln:stravaActivities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Strava Activities';

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
        foreach (StravaUser::all() as $key => $stravauser) {
            $user = $stravauser;
            if(Carbon::now() > $user->token_expires){
                $refresh = Strava::refreshToken($user->refresh_token);
                $user->update([
                  'access_token' => $refresh->access_token,
                  'refresh_token' => $refresh->refresh_token,
                  'token_expires' => Carbon::createFromTimestamp($refresh->expires_at)
                ]);
            }
            $token = $user->access_token;
            $this->info(Carbon::now());
            $this->info($user->user_id);
            foreach(Strava::activities($token,1,200) as $activitie){

                SA::updateOrCreate(
                    [ 'strava_id' => $activitie->id ],
                    [
                        'user_id' => $user->user_id,
                        'name' => $activitie->name,
                        'distance' => $activitie->distance,
                        'moving_time' => $activitie->moving_time,
                        'elapsed_time' => $activitie->elapsed_time,
                        'total_elevation_gain' => $activitie->total_elevation_gain,
                        'type' => $activitie->type,
                        'start_date' => $activitie->start_date
                    ]
                );
            }
        }
    }
}
