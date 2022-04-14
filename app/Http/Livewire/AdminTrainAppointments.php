<?php

namespace App\Http\Livewire;

use App\Models\TrainAppointment;
use App\Models\TrainAppointmentPivot;
use App\Models\TrainBook;
use App\Models\Trainer;
use App\Models\Training;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Session as FlashSession;

class AdminTrainAppointments extends Component
{
    public $days = ['Lun','Mar','Mie','Jue','Vie','Sab'];
    public $now = '';
    public $dates = [];
    public $nodates = [];
    public $classShow = false;
    public $createShow = true;
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
    public $trainings_g;
    public $trainings_s;
    public $newAppointment;
    public $coach;
    public $newname;
    public $newdate;
    public $newhour;
    public $places;

    public function mount()
    {
        $this->now = Carbon::Now();
        $this->newAppointment = 0;
        $this->coach = 0;
        // $this->selectedPlans = Training::where('id','>',0)->pluck('id')->toArray();
        // $this->plans = DB::table('train_appointments_pivot')->distinct('train_appointment_id')->pluck('train_appointment_id')->toArray();
    }

    public function updateSelectedPlans(){
        $this->selectedTrainer = [];
        $this->plans = DB::table('train_appointments_pivot')
            ->whereIN('training_id',$this->selectedPlans)
            ->pluck('train_appointment_id')
            ->toArray();
    }

    public function updateSelectedTrainer(){
        $this->selectedPlans = [];
        $this->plans = DB::table('train_appointments')
            ->whereIN('trainer_id',$this->selectedTrainer)
            ->pluck('id')
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

    public function trainAppointmentDelete($id){
        TrainAppointment::find($id)->delete();
        TrainAppointmentPivot::where('train_appointment_id',$id)->delete();
        $this->classShow = false ;
        $this->train = null;
        $this->name = null;
        $this->date = null;
        $this->hour = null;
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

    public function trainAppointmentCreate(){
        $validate = $this->validate([
            'newAppointment' => ['required','min:1'],
            'coach' => ['required','min:1'],
            'newname' => ['required'],
            'newdate' => ['required'],
            'newhour' => ['required'],
            'places' => ['required','min:1'],
        ]);

        $trainAppointment = new TrainAppointment;
        $trainAppointment->trainer_id = $this->coach;
        $trainAppointment->name = $this->newname;
        $trainAppointment->date = $this->newdate;
        $trainAppointment->hour = $this->newhour;
        $trainAppointment->places = $this->places;
        $trainAppointment->description = 'No Disponible';
        $trainAppointment->save();
        $training = Training::find($this->newAppointment);
        if($training->type == 'group'){

            $trainings = Training::where('name',$training->name)->where('format',$training->format)->get();
            foreach($trainings as $training){
                $tap = new TrainAppointmentPivot;
                $tap->training_id = $training->id;
                $tap->train_appointment_id = $trainAppointment->id;
                $tap->save();
            }
        }
        else {
            $tap = new TrainAppointmentPivot;
            $tap->training_id = $training->id;
            $tap->train_appointment_id = $trainAppointment->id;
            $tap->save();
        }
        $this->selectedPlans = [];
        $this->plans = DB::table('train_appointments')
            ->whereIN('trainer_id',$this->selectedTrainer)
            ->pluck('id')
            ->toArray();
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

    public function openCreate(){
        $this->createShow = true ;
    }

    public function closeCreate(){
        $this->createShow = false;
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

        $this->trainings_g = Training::where('type','group')->groupby('format', 'name')->orderby('name', 'asc')->get();
        $this->trainings_s = Training::where('type','!=','group')->orderby('name', 'asc')->get();
        $this->coachs = Trainer::with('user')->get();

        return view('livewire.admin-train-appointments');
    }
}
