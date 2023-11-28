<?php

namespace App\Http\Livewire;

use App\Models\Student;
use Livewire\Component;
use App\Models\TrainAppointment;
use App\Models\Training;
use App\Models\User;
use App\Models\TrainBook;
use Carbon\Carbon;

class TrainAppointmentComponent extends Component
{
    public $trainAppointments;
    public $trainAppointment;
    public $trainBooks;
    public $train;
    public $users;
    public $students;
    public $searchTermUser;
    public $searchTermStudent;
    public $selectedUserId;
    public $currentWeekTrainAppointments;

    public function mount()
    {
        // All users raw db concat user name and rut
        $this->users = User::selectRaw('CONCAT(name, " ", lastnames, " ", rut) as full_name, id')->get();

        // AllStudents group by user_id
        $this->students = User::join('students', 'users.id', '=', 'students.user_id')->selectRaw('CONCAT(name, " ", lastnames, " ", rut) as full_name, users.id')->groupby('users.id')->get();
        
        // Obtener las clases de la actual semana
        $now = Carbon::now();
        $this->currentWeekTrainAppointments = TrainAppointment::whereBetween('date', [$now->startOfWeek(), $now->endOfWeek()])->get();
        $this->trainBooks = [];
    }

    public function selectStudent($id){
        $user = User::find($id);
        $trainBook = new TrainBook();
        $trainBook->user_id = $user->id;
        $trainBook->train_appointment_id = $this->train;
        $trainBook->status = 1;
        $trainBook->save();
        $this->trainBooks = TrainAppointment::find($this->train)->Bookings;
        $this->searchTermStudent = '';
    }

    public function selectTrainAppointment($id){
        $this->train = $id;
        $this->trainBooks = TrainAppointment::find($id)->Bookings;
    }

    public function status($id){
        $trainBook = TrainBook::find($id);
        $trainBook->status = !$trainBook->status;
        $trainBook->save();
        $this->trainBooks = TrainAppointment::find($trainBook->train_appointment_id)->Bookings;
    }

    public function delete($id){
        $trainBook = TrainBook::find($id);
        $trainBook->delete();
        $this->trainBooks = TrainAppointment::find($trainBook->train_appointment_id)->Bookings;
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

        if (empty($this->searchTermStudent)) {
            $this->students = '';
        }
        else {
            $ids = User::search($this->searchTermStudent)->get()->pluck('id');
            $this->students = User::join('students', 'users.id', '=', 'students.user_id')->selectRaw('CONCAT(name, " ", lastnames, " ", rut) as full_name, users.id')->whereIn('users.id', $ids)->groupby('users.id')->get();
        }
        $now = Carbon::now();
        $this->trainAppointments = TrainAppointment::join('train_appointments_pivot', 'train_appointments.id', '=', 'train_appointments_pivot.train_appointment_id')->join('trainings', 'train_appointments_pivot.training_id', '=', 'trainings.id')->where('type', 'Group')->where('date', '>=', $now->startOfWeek()->format('Y-m-d'))->where('date', '<=', $now->endOfWeek()->format('Y-m-d'))
        ->groupby('train_appointments.id')
        ->orderBy('date', 'asc')->orderBy('hour', 'asc')
        ->get();
        return view('livewire.train-appointment-component');
    }

    
}
