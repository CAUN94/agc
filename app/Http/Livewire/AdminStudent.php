<?php

namespace App\Http\Livewire;

use App\Models\Student;
use App\Models\Training;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

class AdminStudent extends Component {

	use WithPagination;

	public $view;
	public $searchTerm;
	public $trainings;
	public $training;
	public $now;

	public function mount($student) {
		$this->user = $student;
		$this->name = $student->name;
		$this->lastnames = $student->lastnames;
		$this->rut = $student->rut;
		$this->gender = $student->gender();
		$this->email = $student->email;
		$this->phone = $student->phone;
		$this->birthday = $student->birthday;
		$this->address = $student->address;
		$this->profile = $student->profilepic();
		$this->description = $student->description;
		$this->view = '';
		$this->userid = $student->id;
		$this->view = '';
		$this->now = Carbon\Carbon::now();
	}

	public function selectPlan($id)
    {
        $this->searchTerm = null;
        $this->training = Training::find($id);
    }

    public function subMonth()
    {
        $this->now->subMonth();
    }

    public function addMonth()
    {
        $this->now->addMonth();
    }

    public function addPlan($id){
		$new_student = new Student;
		$new_student->user_id = $this->user->id;
		$new_student->training_id = $id;
		$new_student->extra = False;
		$new_student->terms = True;
		$new_student->start_day = $this->user->student()->lastPlan()->endMonth();
		$new_student->save();

		return redirect()->to('/adminstudents/'.$this->rut);
    }

	public function render() {

		$query = Training::query();
        if (empty($this->searchTerm)) {
            $this->trainings = Training::where('id', $this->searchTerm)->get();
        } else {
            $columns = ['name','class','days','type','format'];
            foreach ($columns as $column) {
                $query->orWhere($column, 'LIKE', '%' . $this->searchTerm . '%');
            }
            $this->trainings = $query->get();
        }
		return view('livewire.admin-student', [
			'plans' => User::find($this->userid)->allStudentPlan()->paginate(10),
		]);
	}
}
