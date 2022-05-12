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
}
