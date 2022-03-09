<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use App\Models\TrainAppointment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Trainer extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trainAppointments(){
        return DB::table('train_appointments')->where('trainer_id',$this->user->id)->select('train_appointments.*');
    }

    public function trainings(){
        return DB::table('train_appointments')
            ->join('train_appointments_pivot', 'train_appointments.id', '=', 'train_appointments_pivot.train_appointment_id')
            ->join('trainings', 'train_appointments_pivot.training_id', '=', 'trainings.id')
            ->where('trainer_id',$this->user->id)
            ->groupby('trainer_id','trainings.id')
            ->select('trainings.id','trainings.*');
    }

    public function trainAppointmentsMonth(){
        return $this->trainAppointments()->whereBetween('date',$this->month());
    }

    public function trainAppointmentsMonthCheck(){
        return $this->trainAppointmentsMonth()->where('status',true);
    }


    public function month(){
        if (Carbon::now()->format('d') <= 21 ){
            $startOfMonth = Carbon::createFromDate(Carbon::Now()->format('Y'),Carbon::Now()->format('m')-1,21)->startOfDay();
            $endOfMonth = Carbon::createFromDate(Carbon::Now()->format('Y'),Carbon::Now()->format('m'),20)->endOfDay();
        } else {
            $startOfMonth = Carbon::createFromDate(Carbon::Now()->format('Y'),Carbon::Now()->format('m'),21)->startOfDay();
            $endOfMonth = Carbon::createFromDate(Carbon::Now()->format('Y'),Carbon::Now()->format('m')+1,20)->endOfDay();
        }
        return [$startOfMonth,$endOfMonth];
    }
}
