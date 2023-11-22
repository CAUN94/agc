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
    public $selectedUserId;
    public $currentWeekTrainAppointments;

    public function mount()
    {
        // Obtener la lista de usuarios
        $this->users = User::all();
        
        // Obtener las clases de la actual semana
        $now = Carbon::now();
        $this->currentWeekTrainAppointments = TrainAppointment::whereBetween('date', [$now->startOfWeek(), $now->endOfWeek()])->get();
    }

    public function render()
    {
        $this->trainAppointments = TrainAppointment::join('train_appointments_pivot as tap', 'train_appointments.id', '=', 'tap.train_appointment_id')
            ->join('trainings as t', 'tap.training_id', '=', 't.id')
            ->where('type', 'alone')
            ->select('train_appointments.*', 't.*')
            ->get();

        return view('livewire.train-appointment-component');
    }

    
}
