<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StravaActivities;

class StravaUser extends Model
{
    use HasFactory;

    protected $fillable = ['strava_id', 'username', 'access_token', 'refresh_token', 'token_expires', 'activities_until', 'avatar', 'total_distance_meters', 'total_distance_miles', 'total_moving_time', 'total_activities', 'walk_count', 'run_count', 'max_speed', 'profile_link', 'last_took_lead', 'is_in_lead', 'time_in_lead', 'time_in_lead_hum', 'token_expires'];

    protected $dates = ['token_expires', 'activities_until', 'last_took_lead'];

    protected $hidden = ['access_token', 'refresh_token'];

    public function activities()
    {
        return $this->hasMany(StravaActivities::class, 'strava_id', 'strava_id');
    }

    public function strava(){
        return $this->hasOne(StravaUser::class);
    }
}
