<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Models\TrainAppointment;
use App\Models\TrainClass;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function plan()
    {
        return $this->name." ".$this->format;
    }

    public function planClass()
    {
        return $this->class;
    }

    public function selectClass()
    {
        return Training::where('format',$this->format)->where('name',$this->name)->get();
    }

    public function planClassComplete()
    {
        return $this->class." clase".$this->plural()." por mes";
    }

    public function plural()
    {
        if ($this->class>1){
            return "s";
        }
        return "";
    }

    public function time()
    {
        return $this->time_in_minutes." minutos";
    }

    public function price()
    {
        return Helper::moneda_chilena($this->price);
    }

    public function daysCheck($date){
        return $this->TrainAppointments()->where('date',$date)->orderby('hour','ASC')->get();
    }

    public function trainAppointments(){
        return $this->belongsToMany(TrainAppointment::class,
            'train_appointments_pivot',
            'training_id',
            'train_appointment_id');
    }

    public function classSelect($value){
        return Training::where('name',$this->name)->orderby($value,'ASC')->distinct($value)->get($value);
    }
}
