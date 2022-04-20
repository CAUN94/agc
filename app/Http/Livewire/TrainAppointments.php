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
    public $train = null;

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
