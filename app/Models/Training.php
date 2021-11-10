<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Models\TrainAppointment;
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
        return $this->class." clase".$this->plural();
    }

    public function planClassComplete()
    {
        return $this->class." clase".$this->plural()." por mes";
    }

    public function time()
    {
        return $this->time_in_minutes." minutos";
    }

    public function price()
    {
        return Helper::moneda_chilena($this->price);
    }

    public function plural()
    {
        if ($this->class>1){
            return "s";
        }
        return "";
    }

    public function daysCheck($date){
        return $this->TrainAppointments()->where('date',$date)->orderby('hour','ASC')->get();
    }

    public function TrainAppointments(){
        return $this->hasMany(TrainAppointment::class);
    }
}
