<?php

namespace App\Http\Controllers;

use App\Models\StravaActivity;
use App\Models\StravaUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    }

    public function show(){
        $user = Auth::user()->strava;

        if(is_null($user)){
            return redirect('/strava/auth');
        }

        return view('strava.show');
    }

    public function showjson($id){
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
            $user = StravaUser::where('id', $id)->first();
        }

        $token = $user->access_token;

        $activities = Strava::activities($token,1,200);

        $chargesAndProgress = $this->chargesAndProgress($activities);
        return $chargesAndProgress[3];
    }

    public function showjsoniver($id){
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
            $user = StravaUser::where('id', $id)->first();
        }

        $token = $user->access_token;

        $activities = Strava::activities($token,1,200);

        $chargesAndProgress = $this->chargesAndProgress($activities);

        $jsoniver = [];
        foreach($chargesAndProgress[3] as $key => $charges){
            if(count($charges)<= 0){
                continue;
            }
            foreach($charges as $value){
                $jsoniver[$key] = $value->distance;
            }
        }
        return $jsoniver;
    }

        /**
     * Authenticate user with Strava
     *
     * @return mixed
     */
    public function auth()
    {
        if (!env('ALLOW_STRAVA_AUTH', false)) {
            return redirect("/strava/show");
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

    public function adminshow($id)
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
            $user = StravaUser::where('id', $id)->first();
        }



        $token = $user->access_token;

        $activities = Strava::activities($token,1,200);

        $chargesAndProgress = $this->chargesAndProgress($activities);
        $charges = $chargesAndProgress[0];
        $progress = $chargesAndProgress[1];

        return view('strava.adminshow',compact('user','activities','charges','progress'));
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
        $user->user_id = Auth::user()->id;
        $user->username = $token->athlete->username;
        $user->access_token = $token->access_token;
        $user->refresh_token = $token->refresh_token;
        $user->token_expires = Carbon::createFromTimestamp($token->expires_at);
        $user->avatar = $token->athlete->profile;
        $user->save();
        return redirect('/strava/show');
    }

    public function chargesAndProgress($activities){
        $activities_run = array_filter($activities, function($activities){
            return $activities->type == 'Run';
        });
        if(count($activities_run) == 0){
            return -1;
        }
        $last_start_date = reset($activities_run)->start_date;
        // ddd($activities_run[array_key_last($activities_run)]);
        $first_start_date = $activities_run[array_key_last($activities_run)]->start_date;
        $now = \Carbon\Carbon::now();
        $first_start_date = \Carbon\Carbon::parse($first_start_date);
        $diff = $first_start_date->diffInDays($now);

        $activities_run_used = array_filter($activities_run, function($activities_run) use($diff){
            $weekStartDate = \Carbon\Carbon::now();
            $weekEndDate = \Carbon\Carbon::now()->subdays(($diff == 7*4) ? $diff : 7*4);
            if(\Carbon\Carbon::parse($activities_run->start_date)->between($weekStartDate,$weekEndDate)){
                return $activities_run;
            }
        });

        $weeks = [];
        for($i = 0; $i < intdiv($diff,7); $i++){
            $week = array_filter($activities_run, function($activities_run) use($i,$last_start_date){
                $weekStartDate = \Carbon\Carbon::now();
                $weekEndDate = \Carbon\Carbon::now()->subdays(7);

                if($i > 0){
                    $weekStartDate->subweeks($i);
                    $weekEndDate->subweeks($i);
                }

                return \Carbon\Carbon::parse($activities_run->start_date)->between($weekStartDate,$weekEndDate);
            });
            $weeks[\Carbon\Carbon::now()->subweeks($i)->format('Y-m-d H:i')] = $week;
        }
        $sumweek_time = [];
        foreach($weeks as $week){
            $sumweek_time[] = array_sum(array_map(function($week) {
              return $week->moving_time;
            }, $week))/60;
        }
        $sumweek_distance = [];
        foreach($weeks as $week){
            $sumweek_distance[] = array_sum(array_map(function($week) {
              return $week->distance;
            }, $week));
        }
        $last_weeks = array_slice($sumweek_distance, -3, 3, true);

        // return $last_weeks;
        // return $sumweek_distance;
        $sumweek_distance_avg = array_sum($last_weeks)/count($last_weeks);
        if($sumweek_distance_avg == 0){
            $charges = -1;
        } else {
            $charges = $sumweek_distance[0]/$sumweek_distance_avg;
        }

        if($sumweek_distance[1] == 0){
            $progress = -1;
        } else {
            $progress = $sumweek_distance[0]/$sumweek_distance[1];
        }
        return [$charges,$progress,$activities_run_used,$weeks];

    }

}
