<?php

namespace App\Http\Livewire;

use App\Models\ActionMl;
use App\Models\AppointmentMl;
use App\Models\PaymentMl;
use App\Models\Student;
use App\Models\Training;
use App\Models\TreatmentMl;
use App\Models\User;
use App\Models\UserMl;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;
use Session as FlashSession;

class AdminIndexPanel extends Component
{
    public $usersApp;
    public $studentsApp;
    public $usersMl;
    public $actionsMl;
    public $appointmenstMl;
    public $paymentsMl;
    public $treatmentsMl;
    public $now;
    public $startOfMonth;
    public $endOfMonth;
    public $plans;

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

    public function incrementMonth(){
        $this->startOfMonth = $this->startOfMonth->addMonth();
        $this->endOfMonth = $this->endOfMonth->addMonth();
    }

    public function subMonth(){
        $this->startOfMonth = $this->startOfMonth->subMonth();
        $this->endOfMonth = $this->endOfMonth->subMonth();
    }


    public function render()
    {
        $this->usersApp = User::whereBetween('created_at',[$this->startOfMonth,$this->endOfMonth])->count();
        $this->studentsApp = Student::whereBetween('created_at',[$this->startOfMonth,$this->endOfMonth])->count();
        $this->usersMl = UserMl::whereBetween('Fecha_Ingreso',[$this->startOfMonth,$this->endOfMonth])->count();
        $this->actionsMl = ActionMl::whereBetween('Fecha_Realizacion',[$this->startOfMonth,$this->endOfMonth])->count();
        $this->appointmenstMl = AppointmentMl::whereBetween('Fecha',[$this->startOfMonth,$this->endOfMonth])->count();
        $this->paymentsMl = PaymentMl::whereBetween('Fecha',[$this->startOfMonth,$this->endOfMonth])->count();
        $this->treatmentsMl = TreatmentMl::whereBetween('created_at',[$this->startOfMonth,$this->endOfMonth])->count();
        $this->plans = Training::all()->count();
        return view('livewire.admin-index-panel');
    }
}
