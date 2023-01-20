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
use Livewire\WithPagination;

class AdminRemuneracion extends Component
{
    use WithPagination;

    public $days = ['Lun','Mar','Mie','Jue','Vie','Sab'];
    public $now = '';
    public $dates = [];
    public $nodates = [];
    public $classShow = true;
    public $classShowAppointment = false;
    public $weekly = false;
    public $width = '16.66%';
    public $height = '120px';
    public $heightbox = '80px';
    public $atenciones = null;
    public $date;
    public $name;
    public $namePaciente;
    public $remuneracion;
    public $treatment = null;
    public $hour;
    public $message;
    public $lista_id = '';
    public $coach;
    public $newname;
    public $newdate;
    public $newhour;
    public $places;

    public function mount()
    {
      $this->now = Carbon::Now();
        if (Carbon::now()->format('d') < 21 ){
            $this->startOfMonth = Carbon::createFromDate($this->now->format('Y'),$this->now->format('m')-1,21)->startOfDay();
            $this->actualstartOfMonth = Carbon::createFromDate(Carbon::Now()->format('Y'),Carbon::Now()->format('m')-1,21)->startOfDay();
            $this->expiredstartOfMonth = Carbon::createFromDate(Carbon::Now()->format('Y'),Carbon::Now()->format('m')-1,21)->startOfDay()->subMonth();
            $this->endOfMonth = Carbon::createFromDate($this->now->format('Y'),$this->now->format('m'),20)->endOfDay();
            $this->expiredendOfMonth = Carbon::createFromDate(Carbon::Now()->format('Y'),Carbon::Now()->format('m'),20)->startOfDay()->subMonth();

            $this->startOfWeek = Carbon::createFromDate($this->now->format('Y'),$this->now->startOfWeek()->format('m'),$this->now->startOfWeek()->format('d'))->startOfDay();
            $this->endOfWeek = Carbon::createFromDate($this->now->format('Y'),$this->now->endOfWeek()->format('m'),$this->now->endOfWeek()->format('d'))->startOfDay();
        } else {

            $this->startOfMonth = Carbon::createFromDate($this->now->format('Y'),$this->now->format('m'),21)->startOfDay();
            $this->actualstartOfMonth = Carbon::createFromDate(Carbon::Now()->format('Y'),Carbon::Now()->format('m'),21)->startOfDay();
            $this->expiredstartOfMonth = Carbon::createFromDate(Carbon::Now()->format('Y'),Carbon::Now()->format('m'),21)->startOfDay()->subMonth();
            $this->endOfMonth = Carbon::createFromDate($this->now->format('Y'),$this->now->format('m')+1,20)->endOfDay();
            $this->expiredendOfMonth = Carbon::createFromDate(Carbon::Now()->format('Y'),Carbon::Now()->format('m')+1,20)->startOfDay()->subMonth();

            $this->startOfWeek = Carbon::createFromDate($this->now->format('Y'),$this->now->startOfWeek()->format('m'),$this->now->startOfWeek()->format('d'))->startOfDay();
            $this->endOfWeek = Carbon::createFromDate($this->now->format('Y'),$this->now->endOfWeek()->format('m'),$this->now->endOfWeek()->format('d'))->startOfDay();
        }
        $this->now = Carbon::Now()->subMonth();

        $this->newAppointment = 0;
        $this->coach = 0;

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

    public function show($id){
      $Professional = DB::table('professionals')
                          ->where('user_id',$id)
                          ->first(['description']);
                          $this->lista_id = $Professional->description;
                          $this->classShow = false;
    }

    public function showAppointment($id){
        $this->treatment = appointmentMl::find($id);
        $this->namePaciente = $this->treatment->Nombre_paciente . " " . $this->treatment->Apellidos_paciente;
        $this->date = Carbon::parse($this->treatment->Fecha)->format('d-M-Y');
        $this->convenio = $this->treatment->Convenio;
        $this->classShowAppointment = true;
        //dd($this->remuneracion);
        //$this->remuneracion = $this->treatment->Total;
    }

    public function close(){
        $this->classShow = true;
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

      return view('livewire.admin-remuneracion', [
          'appointments' => ActionMl::where('Estado','Atendido')
                                ->where('Fecha_Realizacion','>',$this->expiredstartOfMonth->format('Y-m-d'))
                                ->where('Fecha_Realizacion','<',$this->expiredendOfMonth->format('Y-m-d'))
                                ->where('Profesional',$this->lista_id)
                                ->groupBy('Tratamiento_Nr')
                                ->orderby('Fecha_Realizacion', 'DESC')
                                ->Paginate(13),

          'coeff' => Professional::where('description',$this->lista_id)->first(['coeff']),
      ]);
    }
}
