<?php

namespace App\Models;

use App\Models\Training;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Training(){
        return $this->belongsTo(Training::class);
    }

    public function isSettled()
    {
        if ($this->settled == 1){
            return True;
        }
        return False;
    }

    public function isStartday($date)
    {
        $end_day = \Carbon\Carbon::parse($this->start_day);
        if($end_day->dayOfWeek == 0){
            $end_day->addDays(1);
        }
        $date = \Carbon\Carbon::parse($date);
        if ($end_day->diffInDays($date,false) == 0){
            return true;
        }
        return false;
    }

    public function lastPayPlan(){
        $actual = $this->nextPlan();
        while($actual->nextPlan()){
            if(!$actual->nextPlan()->isSettled()){
                return $actual;
            }
            $actual = $actual->nextPlan();
        }
        return $actual;
    }

    public function islastday($date)
    {
        $end_day = \Carbon\Carbon::parse($this->start_day)->addDays(30);
        if($end_day->dayOfWeek == 0){
            $end_day->addDays(1);
        }
        $date = \Carbon\Carbon::parse($date);
        if ($end_day->diffInDays($date,false) == 0){
            return $this;
        }
        $actual = $this;
        while($actual->nextPlan()){
            $actual = $actual->nextPlan();
            $end_day = \Carbon\Carbon::parse($actual->start_day)->addDays(30);
            if($end_day->dayOfWeek == 0){
                $end_day->addDays(1);
            }
            $date = \Carbon\Carbon::parse($date);
            if ($end_day->diffInDays($date,false) == 0){
                return $actual;
            }
        }

        return false;
    }

    public function endMonth()
    {
        $endMonth = \Carbon\Carbon::parse($this->start_day);
        return $endMonth->addDays(30);
    }

    public function start_day()
    {
        $start_day = \Carbon\Carbon::parse($this->start_day);
        return $start_day->format('d M Y');
    }

    public function availableday($date){
        $start_day = \Carbon\Carbon::parse($this->start_day);
        $date = \Carbon\Carbon::parse($date);
        $now = \Carbon\Carbon::now();
        $diff = $start_day->diffInDays($date,false);
        $status = true;
        if ($start_day->diffInDays($date,false) < 0){
            $status = false;
        }
        if ($now->diffInDays($date,false) < 0) {
            $status = false;
        }
        $days = 5;
        if ($this->isSettled()){
            $days += 30;
        }
        if ($start_day->diffInDays($date,false) > $days){
            $status = false;
        }
        return $status;
    }

    public function diffdaysPlan()
    {
        $days = \Carbon\Carbon::parse($this->start_day)->addDays(30)->diffInDays();

        if ($days == 1){
            return $days." día";
        }
        return $days." días";
    }

    // public function getStart_dayAttribute()
    // {
    //     return \Carbon\Carbon::parse($this->attributes['start_day'])->format('H:i');
    // }

    public function nextPlan()
    {
        $start_day =  \Carbon\Carbon::parse($this->start_day);
        $end_day = \Carbon\Carbon::parse($this->endMonth());
        $student = Student::where('user_id',Auth::id())
            ->where('start_day','>', $start_day)
            ->where('start_day','<=',$end_day)
            ->where('settled',true);
        if ($student->count() >= 1){
            return $student->first();
        }

        return False;
    }

    public function isRenew(){
        if ($this->nextPlan()){
            return $this->nextPlan()->isSettled();
        }
        return false;
    }
}
