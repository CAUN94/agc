<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\TrainAppointment;
use App\Models\Training;
use App\Models\User;
use App\Models\TrainBook;
use Carbon\Carbon;

class TrainAppointmentComponent extends Component
{
    public $trainAppointments;
    public $users;
    public $searchTermUser;
    public $selectedUserId;
    public $currentWeekTrainAppointments;

    public function mount()
    {
        // All users raw db concat user name and rut
        $this->users = User::selectRaw('CONCAT(name, " ", lastnames, " ", rut) as full_name, id')->get();
        
        // Obtener las clases de la actual semana
        $now = Carbon::now();
        $this->currentWeekTrainAppointments = TrainAppointment::whereBetween('date', [$now->startOfWeek(), $now->endOfWeek()])->get();
    }

    public function selectUser($id){
        $this->user = User::find($id);
    }

    public function render()
    {
        if (empty($this->searchTermUser)) {
            $this->users = '';
        }
        else {
            $ids = User::search($this->searchTermUser)->get()->pluck('id');
            $this->users = User::selectRaw('CONCAT(name, " ", lastnames, " ", rut) as full_name, id')->whereIn('id', $ids)->get();
        }
        // All train appointments from this week
        $this->trainAppointments = TrainAppointment::join('train_appointments_pivot', 'train_appointments.id', '=', 'train_appointments_pivot.train_appointment_id')->join('trainings', 'train_appointments_pivot.training_id', '=', 'trainings.id')->where('type', 'Group')->whereDate('date', '2023-11-27')->groupby('train_appointments.id')->get();
    
            
        return view('livewire.train-appointment-component');
    }

    
}
