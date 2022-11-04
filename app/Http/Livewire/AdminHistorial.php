<?php

namespace App\Http\Livewire;

use App\Models\ProfesionalAppointment;
use App\Models\AppointmentMl;
use App\Models\ActionMl;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Session as FlashSession;

class AdminHistorial extends Component
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
    public $treatment = null;
    public $train = null;
    public $firstRemuneration;
    public $firstPeriod;
    public $periods = [];
    public $date;
    public $name;
    public $namePaciente;
    public $remuneracion;
    public $hour;
    public $newname;
    public $newdate;
    public $newhour;
    public $places;

    public function mount()
    {
        $this->now = Carbon::Now();
        $this->now = Carbon::Now();
        if (Carbon::now()->format('d') <= 21 ){
            $this->startOfMonth = Carbon::createFromDate($this->now->format('Y'),$this->now->format('m')-1,21)->startOfDay();
            $this->actualstartOfMonth = Carbon::createFromDate(Carbon::Now()->format('Y'),Carbon::Now()->format('m')-1,21)->startOfDay();
            $this->expiredstartOfMonth = Carbon::createFromDate(Carbon::Now()->format('Y'),Carbon::Now()->format('m')-1,21)->startOfDay()->subMonth();
            $this->endOfMonth = Carbon::createFromDate($this->now->format('Y'),$this->now->format('m'),20)->endOfDay();
        } else {
            $this->startOfMonth = Carbon::createFromDate($this->now->format('Y'),$this->now->format('m'),21)->startOfDay();
            $this->actualstartOfMonth = Carbon::createFromDate(Carbon::Now()->format('Y'),Carbon::Now()->format('m'),21)->startOfDay();
            $this->expiredstartOfMonth = Carbon::createFromDate(Carbon::Now()->format('Y'),Carbon::Now()->format('m'),21)->startOfDay()->subMonth();
            $this->endOfMonth = Carbon::createFromDate($this->now->format('Y'),$this->now->format('m')+1,20)->endOfDay();
        }
        $this->newAppointment = 0;
        $this->coach = 0;
        // $this->selectedPlans = Training::where('id','>',0)->pluck('id')->toArray();
        // $this->plans = DB::table('train_appointments_pivot')->distinct('train_appointment_id')->pluck('train_appointment_id')->toArray();
    }

    public function subPeriod(){
        $this->startOfMonth->subMonth();
        $this->endOfMonth->subMonth();
    }

    public function addPeriod(){
        $this->startOfMonth->addMonth();
        $this->endOfMonth->addMonth();
    }

    public function subMonth()
    {
        $this->now->subMonth();
    }

    public function incrementMonth()
    {
        $this->now->addMonth();
    }

    public function endPeriod($startOfPeriod){
      return (Carbon::createFromDate(Carbon::parse($startOfPeriod)->format('Y'),Carbon::parse($startOfPeriod)->format('m')+1,20)->startOfDay())->format('Y-m-d');
    }

    public function render()
    {

      $firstRemuneration = DB::table('professionals')
            ->join('action_mls', 'professionals.description', '=', 'action_mls.Profesional')
            ->where('professionals.user_id',Auth::user()->id)
            ->orderBy('Fecha_Realizacion', 'ASC')
            ->get()
            ->first();

        if (Carbon::parse($firstRemuneration->Fecha_Realizacion)->format('d') <=  21 and $firstRemuneration != NULL){
            $firstPeriod = Carbon::createFromDate(Carbon::parse($firstRemuneration->Fecha_Realizacion)->format('Y'),Carbon::parse($firstRemuneration->Fecha_Realizacion)->format('m')-1,21)->startOfDay();
        } else {
            $firstPeriod = Carbon::createFromDate(Carbon::parse($firstRemuneration->Fecha_Realizacion)->format('Y'),Carbon::parse($firstRemuneration->Fecha_Realizacion)->format('m'),21)->startOfDay();
          }


          $lastPeriod = $this->expiredstartOfMonth;

          while($firstPeriod != $lastPeriod){
            $this->periods[] = $lastPeriod;
            $lastPeriod = Carbon::createFromDate(Carbon::parse($lastPeriod)->format('Y'),Carbon::parse($lastPeriod)->format('m')-1,21)->startOfDay();
          }

          $this->periods[] = $firstPeriod;

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

        return view('livewire.admin-historial');
    }
}
