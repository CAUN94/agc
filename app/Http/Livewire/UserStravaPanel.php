<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\StravaActivity;
use App\Models\StravaUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Strava;

class UserStravaPanel extends Component
{

    public function render()
    {
        $this->user = Auth::user()->strava;

        if(Carbon::now() > $this->user->token_expires){
            // Token has expired, generate new tokens using the currently stored user refresh token
            $refresh = Strava::refreshToken($this->user->refresh_token);
            Auth::user()->strava->update([
              'access_token' => $refresh->access_token,
              'refresh_token' => $refresh->refresh_token,
              'token_expires' => Carbon::createFromTimestamp($refresh->expires_at)
            ]);
            $this->user = Auth::user()->strava->first();
        }

        $token = $this->user->access_token;

        $this->activities = Strava::activities($token,1,200);
        $chargesAndProgress = $this->chargesAndProgress($this->activities);
        $this->charges = $chargesAndProgress[0];
        $this->progress = $chargesAndProgress[1];
        $this->user = User::find($this->user->user_id);
        $this->activities = array_filter($this->activities, function($activities){
            return $activities->type == 'Run';
        });
        $this->activities_run_used = $chargesAndProgress[2];
        if( (0.8 <= $this->charges) && ($this->charges <= 1.3)){
            $this->chargeColor = 'green';
        } else {
            $this->chargeColor = 'yellow';
        }
        if($this->progress <= 10){
            $this->progresColor = 'green';
        } else {
            $this->progresColor = 'yellow';
        }
        $this->allData = $chargesAndProgress[3];
        return view('livewire.user-strava-panel');
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
        // ddd($sumweek_distance);
        $last_weeks = array_slice($sumweek_distance, 1, 3, true);

        // ddd($last_weeks);
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
            $progress = 1 - $sumweek_distance[0]/$sumweek_distance[1];
        }
        return [$charges,$progress,$activities_run_used,$weeks];

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
}
