<?php

namespace App\Models;

use App\Models\Training;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TrainAppointment extends Model
{
    use HasFactory;

    public function training(){
        return $this->belongsTo(Training::class);
    }

    public function trainer(){
        return $this->hasOne(User::class, 'id','trainer_id');
    }

    public function DayCheck($date){
        if ($this->date == $date){
            return $this;
        }
        return False;
    }

    public static function AllDayCheck($date){
        return TrainAppointment::where('date',$date)->get();
    }

    public function date(){
        return Carbon::parse($this->date)->format('d M Y');
    }

    public function getHourAttribute(){
        return Carbon::parse($this->attributes['hour'])->format('H:i');
    }
}
