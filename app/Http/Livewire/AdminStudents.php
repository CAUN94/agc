<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Training;
use App\Models\Student;
use Carbon\Carbon;


class AdminStudents extends Component
{
    public $searchTermUser;
    public $searchTermPlan;
    public $trainings;
    public $user;
    public $now;
    public $training;
    public $date;



    public function mount() {
        $this->user = null;
        $this->now = Carbon::now();
    }

    public function subPeriod()
    {
        $this->now->subMonth();
        $this->emit('refreshLivewireDatatable');
    }

    public function addPeriod()
    {
        $this->now->addMonth();
        $this->emit('refreshLivewireDatatable');
    }

    public function selectUser($id){
        $this->user = User::find($id);
        $this->searchTermUser = $this->user->fullName()." ".$this->user->rut;
    }

    public function selectPlan($id){
        $this->training = Training::find($id);
        $this->searchTermPlan = $this->training->planComplete();
    }

    public function addStudent($user,$plan,$date){
        $new_student = new Student;
        $new_student->user_id = $user;
        $new_student->training_id = $plan;
        $new_student->extra = False;
        $new_student->terms = True;
        $new_student->start_day = $date;
        $new_student->save();

        return redirect()->to('/adminstudents');
    }

    public function render()
    {
        $queryt = Training::query();
        if (empty($this->searchTermPlan)) {
            $this->trainings = Training::where('id', $this->searchTermPlan)->get();
        } else {
            $columns = ['name','class','days','type','format'];
            foreach ($columns as $column) {
                $queryt->orWhere($column, 'LIKE', '%' . $this->searchTermPlan . '%');
            }
            $this->trainings = $queryt->get();
        }
        $queryu = User::query();
        if (empty($this->searchTermUser)) {
            $this->users = Training::where('id', $this->searchTermUser)->get();
        } else {
            $columns = ['name','lastnames','rut','email'];
            foreach ($columns as $column) {
                $queryu->orWhere($column, 'LIKE', '%' . $this->searchTermUser . '%');
            }
            $this->users = $queryu->get();
        }
        return view('livewire.admin-students');
    }
}
