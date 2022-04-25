<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Models\TrainAppointment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function trainerRemuneration(){
        $sum = 0;
        foreach ($this->trainAppointmentsMonthCheck()->get() as $key => $checkAppointment) {
            // return TrainAppointment::find($checkAppointment->id)->trainings();
            $training = TrainAppointment::find($checkAppointment->id)->trainings();
            if ($training->type == 'group' and $training->format == 'Presencial') {
                $sum = $sum + 12000;
            } elseif ($training->type == 'group' and $training->format == 'Online') {
                $sum = $sum + 10000;
            } else {
                $sum = $sum + ceil(($training->price/$training->class)*($this->coff/100));
            }
        }
        return Helper::moneda_chilena($sum);
    }
}
