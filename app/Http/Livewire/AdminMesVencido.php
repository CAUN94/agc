<?php

namespace App\Http\Livewire;

use App\Models\ProfesionalAppointment;
use App\Models\AppointmentMl;
use App\Models\ActionMl;
use App\Models\TrainAppointmentPivot;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Session as FlashSession;
use Livewire\WithPagination;


class AdminMesVencido extends Component
{
    use WithPagination;

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
    public $date;
    public $name;
    public $namePaciente;
    public $remuneracion;
    public $hour;
    public $message;

    public function mount()
    {
        $this->now = Carbon::Now();
        if (Carbon::now()->format('d') < 21 ){
            $this->startOfMonth = Carbon::createFromDate($this->now->format('Y'),$this->now->format('m')-1,21)->startOfDay();
            $this->actualstartOfMonth = Carbon::createFromDate(Carbon::Now()->format('Y'),Carbon::Now()->format('m')-1,21)->startOfDay();
            $this->expiredstartOfMonth = Carbon::createFromDate(Carbon::Now()->format('Y'),Carbon::Now()->format('m')-1,21)->startOfDay()->subMonth();
            $this->expiredendOfMonth = Carbon::createFromDate(Carbon::Now()->format('Y'),Carbon::Now()->format('m'),20)->startOfDay()->subMonth();
            $this->endOfMonth = Carbon::createFromDate($this->now->format('Y'),$this->now->format('m'),20)->endOfDay();
        } else {
            $this->startOfMonth = Carbon::createFromDate($this->now->format('Y'),$this->now->format('m'),21)->startOfDay();
            $this->actualstartOfMonth = Carbon::createFromDate(Carbon::Now()->format('Y'),Carbon::Now()->format('m'),21)->startOfDay();
            $this->expiredstartOfMonth = Carbon::createFromDate(Carbon::Now()->format('Y'),Carbon::Now()->format('m'),21)->startOfDay()->subMonth();
            $this->expiredendOfMonth = Carbon::createFromDate(Carbon::Now()->format('Y'),Carbon::Now()->format('m')+1,20)->startOfDay()->subMonth();
            $this->endOfMonth = Carbon::createFromDate($this->now->format('Y'),$this->now->format('m')+1,20)->endOfDay();
        }
        $this->newAppointment = 0;
        $this->coach = 0;
        $this->now = Carbon::Now()->subMonth();
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

    public function close(){
        $this->classShow = false ;
    }

    public function show($id){
        $this->treatment = appointmentMl::find($id);
        $this->classShow = true;
        $this->namePaciente = $this->treatment->Nombre_paciente . " " . $this->treatment->Apellidos_paciente;
        $this->date = Carbon::parse($this->treatment->Fecha)->format('d M Y');
        $this->convenio = $this->treatment->Convenio;
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

        return view('livewire.admin-mes-vencido', [
            'appointments' => ActionMl::join('professionals', 'professionals.description', '=' ,'action_mls.Profesional')
                                  ->where('action_mls.Estado','Atendido')
                                  ->where('Fecha_Realizacion','>',$this->expiredstartOfMonth->format('Y-m-d'))
                                  ->where('Fecha_Realizacion','<',$this->expiredendOfMonth->format('Y-m-d'))
                                  ->where('professionals.user_id',Auth::user()->id)
                                  ->groupBy('Tratamiento_Nr')
                                  ->orderby('Fecha_Realizacion', 'ASC')
                                  ->Paginate(13),
            'coff' => Professional::where('description',$this->lista_id)->first(['coff']),
        ]);
    }
}
