<?php

namespace App\Http\Livewire;

use App\Models\ProfesionalAppointment;
use App\Models\AppointmentMl;
use App\Models\ActionMl;
use App\Models\Professional;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Session as FlashSession;

class AdminConvenios extends Component
{
    public $days = ['Lun','Mar','Mie','Jue','Vie','Sab'];
    public $now = '';
    public $dates = [];
    public $nodates = [];
    public $classShow = false;
    public $createShow = true;
    public $weekly = false;
    public $width = '16.66%';
    public $height = '120px';
    public $heightbox = '80px';
    public $treatment = null;
    public $date;
    public $remuneracion;
    public $newAppointment;


    public function mount()
    {
      $this->now = Carbon::Now();
        if (Carbon::now()->format('d') < 21 ){
            $this->startOfMonth = Carbon::createFromDate($this->now->format('Y'),$this->now->format('m')-1,20)->startOfDay();
            $this->actualstartOfMonth = Carbon::createFromDate(Carbon::Now()->format('Y'),Carbon::Now()->format('m')-1,20)->startOfDay();
            $this->expiredstartOfMonth = Carbon::createFromDate(Carbon::Now()->format('Y'),Carbon::Now()->format('m')-1,20)->startOfDay()->subMonth();
            $this->endOfMonth = Carbon::createFromDate($this->now->format('Y'),$this->now->format('m'),21)->endOfDay();

            $this->startOfWeek = Carbon::createFromDate($this->now->format('Y'),$this->now->startOfWeek()->format('m'),$this->now->startOfWeek()->format('d'))->startOfDay();
            $this->endOfWeek = Carbon::createFromDate($this->now->format('Y'),$this->now->endOfWeek()->format('m'),$this->now->endOfWeek()->format('d'))->startOfDay();
        } else {

            $this->startOfMonth = Carbon::createFromDate($this->now->format('Y'),$this->now->format('m'),20)->startOfDay();
            $this->actualstartOfMonth = Carbon::createFromDate(Carbon::Now()->format('Y'),Carbon::Now()->format('m'),20)->startOfDay();
            $this->expiredstartOfMonth = Carbon::createFromDate(Carbon::Now()->format('Y'),Carbon::Now()->format('m'),20)->startOfDay()->subMonth();
            $this->endOfMonth = Carbon::createFromDate($this->now->format('Y'),$this->now->format('m')+1,21)->endOfDay();

            $this->startOfWeek = Carbon::createFromDate($this->now->format('Y'),$this->now->startOfWeek()->format('m'),$this->now->startOfWeek()->format('d'))->startOfDay();
            $this->endOfWeek = Carbon::createFromDate($this->now->format('Y'),$this->now->endOfWeek()->format('m'),$this->now->endOfWeek()->format('d'))->startOfDay();
        }
        $this->now = Carbon::Now();

        $this->newAppointment = 0;

        // $this->selectedPlans = Training::where('id','>',0)->pluck('id')->toArray();
        // $this->plans = DB::table('train_appointments_pivot')->distinct('train_appointment_id')->pluck('train_appointment_id')->toArray();
    }

    public function weeklyOn()
    {
      $this->weekly = true;
    }

    public function weeklyOff()
    {
      $this->weekly = false;
    }

    public function subMonth()
    {
        $this->now->subMonth();
    }

    public function incrementMonth()
    {
        $this->now->addMonth();
    }

    public function render()
    {
      if($this->weekly)
      {
        $this->now = Carbon::Now();
        $periodnodays = [];
        $perioddays = CarbonPeriod::create($this->now->copy()->startOfWeek(), $this->now->copy()->endOfWeek());
      }else
      {
      $periodnodays = CarbonPeriod::create($this->now->copy()->subMonth()->endOfMonth()->startOfWeek(), $this->now->copy()->subMonth()->endOfMonth());
      $perioddays = CarbonPeriod::create($this->now->copy()->startOfMonth(), $this->now->copy()->endOfMonth());
      }

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

        return view('livewire.admin-convenios', [
            'appointments' => ActionMl::Where('Convenio', 'LIKE' , '%' . Auth::user()->fullname() . '%')
                                  ->where('Estado', 'Atendido')
                                  ->groupBy('Tratamiento_Nr')
                                  ->orderby('Fecha_Realizacion', 'ASC')
                                  ->get(),
        ]);
    }
}
