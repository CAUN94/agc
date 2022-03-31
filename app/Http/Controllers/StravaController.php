<?php

namespace App\Http\Controllers;

use App\Models\StravaActivity;
use App\Models\StravaUser;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Strava;

class StravaController extends Controller
{
    public function index()
    {
        $users = StravaUser::get()->sortByDesc('total_distance_meters');

        // $first = true;
        // $users = $users->each(function($user) use (&$first){
        //     if ($first){
        //         $leader_for = Carbon::parse($user->last_took_lead)->diffInSeconds(Carbon::now());
        //         $user->time_in_lead_hum = $this->secondsToTime($leader_for);
        //         $user->total_time_in_lead = $user->time_in_lead + $leader_for;
        //         $first = false;
        //     } else {
        //         $user->total_time_in_lead = $user->time_in_lead;
        //     }

        //     $user->total_time_in_lead_hum = $this->secondsToTime($user->total_time_in_lead);
        // });
        return view('strava.index',compact('users'));
        // return view('dashboard', ['users' => $users, 'strava_get_activities_time' => Cache::store('file')->get('strava_get_activities_time', 'unknown'), 'strava_next_activities_time' => Cache::store('file')->get('strava_next_activities_time', 'unknown')]);
    }

    public function show($id)
    {

        $user = StravaUser::where('id', $id)->first();

        if(is_null($user)){
            return redirect('/strava/auth');
        }

        if(Carbon::now() > $user->token_expires){
            // Token has expired, generate new tokens using the currently stored user refresh token
            $refresh = Strava::refreshToken($user->refresh_token);
            StravaUser::where('id', $id)->update([
              'access_token' => $refresh->access_token,
              'refresh_token' => $refresh->refresh_token,
              'token_expires' => Carbon::createFromTimestamp($refresh->expires_at)
            ]);
        }

        $token = $user->access_token;
        $activities = Strava::activities($token,1,200);
        $charges = $this->charges($activities);
        // return $charges;
        // return view('strava.show',compact('user','activities'));
        return view('strava.show',compact('user','activities','charges'));
    }

    /**
     * Authenticate user with Strava
     *
     * @return mixed
     */
    public function auth()
    {
        if (!env('ALLOW_STRAVA_AUTH', false)) {
            return redirect("/strava");
        }
        return Strava::authenticate($scope='read_all,profile:read_all,activity:read_all');
    }

    public function unauth()
    {
        if (!env('ALLOW_STRAVA_AUTH', false)) {
            return redirect("/strava");
        }

        Strava::unauthenticate(StravaUser::first()->access_token);

        return redirect("/strava");
    }


    /**
     * Get token from auth callback
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */
    public function authCallback(Request $request)
    {
        if (!env('ALLOW_STRAVA_AUTH', false)) {
            return redirect("/strava");
        }

        // Get access token
        try {
            $token = Strava::token($request->code);
        } catch (\Exception $e) {
            return "Authentication error. Please try again.";
        }

        // Create or update user
        $user = StravaUser::firstOrCreate(['strava_id' => $token->athlete->id]);
        $user->username = $token->athlete->username;
        $user->access_token = $token->access_token;
        $user->refresh_token = $token->refresh_token;
        $user->token_expires = Carbon::createFromTimestamp($token->expires_at);
        $user->avatar = $token->athlete->profile;
        $user->save();
        return redirect('/strava');
    }

    protected function secondsToTime($inputSeconds) {
        $secondsInAMinute = 60;
        $secondsInAnHour = 60 * $secondsInAMinute;
        $secondsInADay = 24 * $secondsInAnHour;

        // Extract days
        $days = floor($inputSeconds / $secondsInADay);

        // Extract hours
        $hourSeconds = $inputSeconds % $secondsInADay;
        $hours = floor($hourSeconds / $secondsInAnHour);

        // Extract minutes
        $minuteSeconds = $hourSeconds % $secondsInAnHour;
        $minutes = floor($minuteSeconds / $secondsInAMinute);

        // Extract the remaining seconds
        $remainingSeconds = $minuteSeconds % $secondsInAMinute;
        $seconds = ceil($remainingSeconds);

        // Format and return
        $timeParts = [];
        $sections = [
            'day' => (int)$days,
            'hour' => (int)$hours,
            'minute' => (int)$minutes,
            'second' => (int)$seconds,
        ];

        foreach ($sections as $name => $value){
            if ($value > 0){
                $timeParts[] = $value. ' '.$name.($value == 1 ? '' : 's');
            }
        }

        return implode(', ', $timeParts);
    }

    public function charges($activities){
        $activities_run = array_filter($activities, function($activities){
            return $activities->type == 'Run';
        });
        $last_start_date = reset($activities_run)->start_date;

        $weeks = [];
        for($i = 0; $i < 4; $i++){
            $week = array_filter($activities_run, function($activities_run) use($i,$last_start_date){
                // $weekStartDate = \Carbon\Carbon::now()->startofweek();
                // $weekEndDate = \Carbon\Carbon::now()->endofweek();
                $weekStartDate = \Carbon\Carbon::parse($last_start_date);
                $weekEndDate = \Carbon\Carbon::parse($last_start_date)->subdays(7);

                if($i > 0){
                    $weekStartDate->subweeks($i);
                    $weekEndDate->subweeks($i);
                }

                return \Carbon\Carbon::parse($activities_run->start_date)->between($weekStartDate,$weekEndDate);
            });
            $weeks[] = $week;
        }
        // return $weeks;
        $sumweek_time = [];
        foreach($weeks as $week){
            $sumweek_time[] = array_sum(array_map(function($week) {
              return $week->moving_time;
            }, $week))/60;
        }
        // return ($sumweek_time);
        $sumweek_distance = [];
        foreach($weeks as $week){
            $sumweek_distance[] = array_sum(array_map(function($week) {
              return $week->distance;
            }, $week))/60;
        }
        // return $sumweek_distance;
        $last_weeks = array_slice($sumweek_distance, -3, 3, true);
        // return $last_weeks;
        // return $sumweek_distance;
        $sumweek_distance_avg = array_sum($last_weeks)/count($last_weeks);
        if($sumweek_distance_avg == 0){
            return -1;
        }
        return $sumweek_distance[0]/$sumweek_distance_avg;
        // return $sumweek_distance4;
        // return [$sumweek_distance1,$sumweek_distance2,$sumweek_distance3,$sumweek_distance4];
        // $array_week = [$sumweek_distance2*3,$sumweek_distance3*3,$sumweek_distance4*3];
    }
}
