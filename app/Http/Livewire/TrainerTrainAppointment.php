<?php

namespace App\Http\Livewire;

use App\Models\TrainAppointment;
use App\Models\TrainBook;
use App\Models\Training;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Session as FlashSession;

class TrainerTrainAppointment extends Component
{
    public $days = ['Lun','Mar','Mie','Jue','Vie','Sab'];
    public $now = '';
    public $dates = [];
    public $nodates = [];
    public $classShow = false;
    public $width = '16.66%';
    public $height = '120px';
    public $heightbox = '80px';
    public $train = null;
    public $selectedPlans = [];
    public $selectedTrainer = [];
    public $plans = [];
    public $date;
    public $name;
    public $hour;
    public $message;
    public $startOfMonth;
    public $endOfMonth;

    public function mount(){
        $this->now = Carbon::Now();
        if (Carbon::now()->format('d') <= 21 ){
            $this->startOfMonth = Carbon::createFromDate($this->now->format('Y'),$this->now->format('m')-1,21)->startOfDay();
            $this->endOfMonth = Carbon::createFromDate($this->now->format('Y'),$this->now->format('m'),20)->endOfDay();
        } else {
            $this->startOfMonth = Carbon::createFromDate($this->now->format('Y'),$this->now->format('m'),21)->startOfDay();
            $this->endOfMonth = Carbon::createFromDate($this->now->format('Y'),$this->now->format('m')+1,20)->endOfDay();
        }
    }

    public function updateSelectedPlans(){
        $this->plans = DB::table('train_appointments')
            ->join('train_appointments_pivot', 'train_appointments.id', '=', 'train_appointments_pivot.train_appointment_id')
            ->where('trainer_id',Auth::user()->id)
            ->whereIN('training_id',$this->selectedPlans)
            ->pluck('train_appointment_id')
            ->toArray();
    }

    public function subMonth()
    {
        $this->now->subMonth();
    }

    public function incrementMonth()
    {
        $this->now->addMonth();
    }

    public function trainAppointmentEdit(){
        $this->validate([
            'name' => ['required'],
            'date' => ['required'],
            'hour' => ['required'],
        ]);
        $trainAppointment = TrainAppointment::find($this->train->id);
        $trainAppointment->name = $this->name;
        $trainAppointment->date = $this->date;
        $trainAppointment->hour = $this->hour;
        $trainAppointment->save();
    }

    public function trainAppointmentStatus(){
        $trainAppointment = TrainAppointment::find($this->train->id);
        $trainAppointment->status = !$trainAppointment->status;
        $trainAppointment->save();
    }

    public function close(){
        $this->classShow = false ;
        $this->train = null;
        $this->name = null;
        $this->date = null;
        $this->hour = null;
    }

    public function show($id){
        $this->train = TrainAppointment::find($id);
        $this->classShow = true ;
        $this->name = $this->train->name;
        $this->date = $this->train->date;
        $this->hour = $this->train->hour;
    }

    public function render()
    {
        $periodnodays = CarbonPeriod::create($this->now->copy()->subMonth()->endOfMonth()->startOfWeek(), $this->now->copy()->subMonth()->endOfMonth());

        $perioddays = CarbonPeriod::create($this->now->copy()->startOfMonth(), $this->now->copy()->endOfMonth());
        $this->nodates = [];
        $this->dates = [];
        foreach($periodnodays as $date)
        {
            if ( !$date->isSunday() ){
                $this->nodates[] = $date;
            }

        }
        foreach($perioddays as $date)
        {
            if ( !$date->isSunday() ){
                $this->dates[] = $date;
            }
        }

        return view('livewire.trainer-train-appointment');
    }
}
