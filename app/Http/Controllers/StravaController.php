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
        $user = StravaUser::find($id);
        $token = $user->access_token;
        $activities = Strava::activities($token,1,200);
        $charges = $this->charges($activities);
        // return $charges;
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
        // return $activities_run;
        $week1 = array_filter($activities_run, function($activities_run){
            $weekStartDate = \Carbon\Carbon::now()->startofweek();
            $weekEndDate = \Carbon\Carbon::now()->endofweek();
            $weekStartDate = \Carbon\Carbon::parse("2021-10-22");
            $weekEndDate = \Carbon\Carbon::parse("2021-10-22")->subdays(7);

            return \Carbon\Carbon::parse($activities_run->start_date)->between($weekStartDate,$weekEndDate);
        });

        $week2 = array_filter($activities_run, function($activities_run){
            $weekStartDate = \Carbon\Carbon::now()->subweek()->startofweek();
            $weekEndDate = \Carbon\Carbon::now()->subweek()->endofweek();
            $weekStartDate = \Carbon\Carbon::parse("2021-10-22")->subdays(7);
            $weekEndDate = \Carbon\Carbon::parse("2021-10-22")->subdays(14);

            return \Carbon\Carbon::parse($activities_run->start_date)->between($weekStartDate,$weekEndDate);
        });

        $week3 = array_filter($activities_run, function($activities_run){
            $weekStartDate = \Carbon\Carbon::now()->subweek(2)->startofweek();
            $weekEndDate = \Carbon\Carbon::now()->subweek(2)->endofweek();
            $weekStartDate = \Carbon\Carbon::parse("2021-10-22")->subdays(14);
            $weekEndDate = \Carbon\Carbon::parse("2021-10-22")->subdays(21);

            return \Carbon\Carbon::parse($activities_run->start_date)->between($weekStartDate,$weekEndDate);
        });

        $week4 = array_filter($activities_run, function($activities_run){
            $weekStartDate = \Carbon\Carbon::now()->subweek(3)->startofweek();
            $weekEndDate = \Carbon\Carbon::now()->subweek(3)->endofweek();
            $weekStartDate = \Carbon\Carbon::parse("2021-10-22")->subdays(21);
            $weekEndDate = \Carbon\Carbon::parse("2021-10-22")->subdays(28);

            return \Carbon\Carbon::parse($activities_run->start_date)->between($weekStartDate,$weekEndDate);
        });

        $sumweek_time1 = array_sum(array_map(function($week1) {
          return $week1->moving_time;
        }, $week1))/60;
        // return $sumweek_time1;

        $sumweek_time2 = array_sum(array_map(function($week2) {
          return $week2->moving_time;
        }, $week2))/60;
        // return $sumweek_time2;

        $sumweek_time3 = array_sum(array_map(function($week3) {
          return $week3->moving_time;
        }, $week3))/60;
        // return $sumweek_time3;

        $sumweek_time4 = array_sum(array_map(function($week4) {
          return $week4->moving_time;
        }, $week4))/60;
        // return $sumweek_time4;


        $sumweek_distance1 = array_sum(array_map(function($week1) {
          return $week1->distance;
        }, $week1))/1000;
        // return $sumweek_distance1;

        $sumweek_distance2 = array_sum(array_map(function($week2) {
          return $week2->distance;
        }, $week2))/1000;
        // return $week2;

        $sumweek_distance3 = array_sum(array_map(function($week3) {
          return $week3->distance;
        }, $week3))/1000;
        // return $sumweek_distance3;

        $sumweek_distance4 = array_sum(array_map(function($week4) {
          return $week4->distance;
        }, $week4))/1000;
        // return $sumweek_distance4;
        // return [$sumweek_distance1,$sumweek_distance2,$sumweek_distance3,$sumweek_distance4];
        $array_week = [$sumweek_distance2*3,$sumweek_distance3*3,$sumweek_distance4*3];
        return ($sumweek_distance1*3)/(array_sum($array_week)/count($array_week));
    }
}
