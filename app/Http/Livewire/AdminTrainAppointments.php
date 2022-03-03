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

class AdminTrainAppointments extends Component
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
    public $plans = [];
    public $date;
    public $name;
    public $hour;
    public $message;

    public function mount()
    {
        $this->now = Carbon::Now();
        // $this->selectedPlans = Training::where('id','>',0)->pluck('id')->toArray();
        // $this->plans = DB::table('train_appointments_pivot')->distinct('train_appointment_id')->pluck('train_appointment_id')->toArray();
    }

    public function updateSelectedPlans(){
        $this->plans = DB::table('train_appointments_pivot')
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

        return view('livewire.admin-train-appointments');
    }
}
