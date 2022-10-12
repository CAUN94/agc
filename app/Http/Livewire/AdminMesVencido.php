<?php

namespace App\Http\Livewire;

use App\Models\ProfesionalAppointment;
use App\Models\AppointmentMl;
use App\Models\ActionMl;
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

class AdminMesVencido extends Component
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
    public $selectedPlans = [];
    public $selectedProfessional = [];
    public $selectedProfessional_id = 0;
    public $plans = [];
    public $date;
    public $name;
    public $namePaciente;
    public $remuneracion;
    public $hour;
    public $message;
    public $trainings_g;
    public $trainings_s;
    public $appointments = [];
    public $coach;
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
            $this->expiredendOfMonth = Carbon::createFromDate(Carbon::Now()->format('Y'),Carbon::Now()->format('m'),20)->startOfDay()->subMonth();
            $this->endOfMonth = Carbon::createFromDate($this->now->format('Y'),$this->now->format('m'),20)->endOfDay();
        } else {
            $this->startOfMonth = Carbon::createFromDate($this->now->format('Y'),$this->now->format('m'),21)->startOfDay();
            $this->actualstartOfMonth = Carbon::createFromDate(Carbon::Now()->format('Y'),Carbon::Now()->format('m'),21)->startOfDay();
            $this->expiredstartOfMonth = Carbon::createFromDate(Carbon::Now()->format('Y'),Carbon::Now()->format('m'),21)->startOfDay()->subMonth();
            $this->expiredendOfMonth = Carbon::createFromDate(Carbon::Now()->format('Y'),Carbon::Now()->format('m')-1,20)->startOfDay()->subMonth();
            $this->endOfMonth = Carbon::createFromDate($this->now->format('Y'),$this->now->format('m')+1,20)->endOfDay();
        }
        $this->newAppointment = 0;
        $this->coach = 0;

        // $this->selectedPlans = Training::where('id','>',0)->pluck('id')->toArray();
        // $this->plans = DB::table('train_appointments_pivot')->distinct('train_appointment_id')->pluck('train_appointment_id')->toArray();
    }

    public function updateSelectedPlans(){
        $this->selectedProfessional = [];
        $this->plans = DB::table('train_appointments_pivot')
            ->whereIN('training_id',$this->selectedPlans)
            ->pluck('train_appointment_id')
            ->toArray();
    }

    public function updateSelectedProfessional(){
        $this->selectedPlans = [];
        $this->selectedProfessional_id = $this->selectedProfessional;
        if(isset($this->selectedProfessional)){
        $this->selectedProfessional = DB::table('professionals')
            ->join('appointment_mls', 'professionals.description', '=', 'appointment_mls.Profesional')
            ->whereIN('professionals.user_id',$this->selectedProfessional)
            ->pluck('appointment_mls.Profesional')
            ->toArray();
        }
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
        $this->treatment = appointmentMl::find($id);
        $this->classShow = true;
        $this->namePaciente = $this->treatment->Nombre_paciente . " " . $this->treatment->Apellidos_paciente;
        $this->date = Carbon::parse($this->treatment->Fecha)->format('d M Y');
        $this->convenio = $this->treatment->Convenio;

        //$this->remuneracion = $this->remuneracion->Total;
        //dd($this->remuneracion);
        //$this->remuneracion = $this->treatment->Total;
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

        $this->appointments = ActionMl::where('Estado','Atendido')
                              ->whereBetween('Fecha_Realizacion',[$this->expiredstartOfMonth->format('Y-m-d'),$this->expiredendOfMonth->format('Y-m-d')])
                              ->whereIN('Profesional',$this->selectedProfessional)
                              ->orderby('Fecha_Realizacion', 'DESC')
                              ->get();

        return view('livewire.admin-mes-vencido');
    }
}
