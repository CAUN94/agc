<?php

namespace App\Http\Livewire;

use App\Models\TrainAppointment;
use App\Models\TrainBook;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Livewire\Component;
use Session as FlashSession;

class TrainAppointments extends Component
{
    public $days = ['Lun','Mar','Mie','Jue','Vie','Sab'];
    public $now = '';
    public $dates = [];
    public $nodates = [];
    public $classShow = false;
    public $width = '16.66%';
    public $height = '120px';
    public $heightbox = '80px';
    public $reservedTraining;
    public $train = null;
    public $trainerSearch;
    public $selectedTraining = null;
    public $selected_date = null;
    public $validReserve = true;
    public $showReserve = false;

    public function mount()
    {
        $this->now = Carbon::Now();
    }

    public function subMonth()
    {
        $this->now->subMonth();
    }

    public function incrementMonth()
    {
        $this->now->addMonth();
    }

    public function show($id){
        $this->train = TrainAppointment::find($id);

        if (Auth::user()->student()->availableday($this->train->date)){
            $this->classShow = true ;
        }
        else {
            $this->train == null;
            $this->classShow = false;
        }
    }

    public function book(){
        if (TrainBook::bookClass(Auth::id(),$this->train->id)){
            session()->flash('primary','Clase ya reservada');
        } else {
            if(Auth::user()->canBook($this->train->id)){
                $trainBook = TrainBook::create([
                    'user_id' => Auth::id(),
                    'train_appointment_id' => $this->train->id
                ]);
                session()->flash('primary','Reservada la clase de '.$trainBook->TrainAppointment->name);
            }
            else {
                session()->flash('primary','Maximo de clases alcanzado');
            }

        }
    }

    public function phonebook($id){
        if(Auth::user()->checkTrainBook($id)->count()>0){
            Auth::user()->checkTrainBook($id)->first()->delete();
            session()->flash('primary','Reserva Cancelada');
        } else {
            if (TrainBook::bookClass(Auth::id(),$id)){
                session()->flash('primary','Clase ya reservada');
            } else {
                $trainBook = TrainBook::create([
                    'user_id' => Auth::id(),
                    'train_appointment_id' => $id
                ]);
                session()->flash('primary','Reservada la clase de '.$trainBook->TrainAppointment->name);
                // if(Auth::user()->canBook($tdid)){
                //     $trainBook = TrainBook::create([
                //         'user_id' => Auth::id(),
                //         'train_appointment_id' => $id
                //     ]);
                //     session()->flash('primary','Reservada la clase de '.$trainBook->TrainAppointment->name);
                // }
                // else {
                //     session()->flash('primary','Maximo de clases alcanzado');
                // }

            }
        }
    }

    public function selectDate($date){
      $this->selected_date = Carbon::createFromDate($this->now->format('Y'),$this->now->format('m'),$date)->format('Y-m-d');
    }

    public function selectTraining($trainingId){
      $this->selectedTraining = $trainingId;
      if(TrainAppointment::find($trainingId)->places - TrainBook::where('train_appointment_id',$trainingId)->count() > 0){
        $this->validReserve = true;
      }else{
        $this->validReserve = false;
      }
    }

    public function reserva($id){
      $this->showReserve = true;
      $this->reservedTraining = TrainAppointment::find($id);
    }

    public function unbook(TrainBook $trainBook){
        session()->flash('primary','Cancelada la reserva');
        $trainBook->delete();
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
        return view('livewire.train-appointments');
    }
}
