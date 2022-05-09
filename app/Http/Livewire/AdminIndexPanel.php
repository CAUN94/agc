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
        $this->usersApp = User::count();
        $this->studentsApp = Student::count();
        $this->usersMl = UserMl::count();
        $this->actionsMl = ActionMl::count();
        $this->appointmenstMl = AppointmentMl::count();
        $this->paymentsMl = PaymentMl::count();
        $this->treatmentsMl = TreatmentMl::count();
        $this->now = Carbon::Now();
        if (Carbon::now()->format('d') <= 21 ){
            $this->startOfMonth = Carbon::createFromDate($this->now->format('Y'),$this->now->format('m')-1,21)->startOfDay();
            $this->endOfMonth = Carbon::createFromDate($this->now->format('Y'),$this->now->format('m'),20)->endOfDay();
        } else {
            $this->startOfMonth = Carbon::createFromDate($this->now->format('Y'),$this->now->format('m'),21)->startOfDay();
            $this->endOfMonth = Carbon::createFromDate($this->now->format('Y'),$this->now->format('m')+1,20)->endOfDay();
        }
        $this->plans = Training::count();
    }

    public function render()
    {
        return view('livewire.admin-index-panel');
    }
}
