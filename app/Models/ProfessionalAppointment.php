<?php

namespace App\Models;

use App\Models\Training;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ProfessionalAppointment extends Model
{
    use HasFactory;

    public function allTrainings(){
        return $this->belongsToMany(Training::class,
            'train_appointments_pivot',
            'train_appointment_id',
            'training_id');
    }

    public function trainings(){
        return $this->belongsToMany(Training::class,
            'train_appointments_pivot',
            'train_appointment_id',
            'training_id')->first();
    }

    public function training(){
        return $this->belongsToMany(Training::class,
            'train_appointments_pivot',
            'train_appointment_id',
            'training_id')->where('training_id',Auth::user()->student()->training_id)->first();
    }


    public function trainer(){
        return $this->hasOne(User::class,'id','trainer_id');
    }

    public function DayCheck($date){
        if ($this->date == $date){
            return $this;
        }
        return False;
    }

    public function isComplete()
    {
        if($this->Bookings->count() == $this->places){
            return True;
        }
        return False;
    }

    public function Bookings()
    {
        return $this->hasMany(TrainBook::class);
    }

     public function isBooking()
    {
        if ($this->Bookings()->where('user_id',Auth::user()->id)->first()){
            return True;
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
