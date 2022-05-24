<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StravaActivities extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','strava_id','name','distance','moving_time','elapsed_time','total_elevation_gain','type','start_date'];


}
