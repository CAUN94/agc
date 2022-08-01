<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AdminStudent extends Component {

	use WithPagination;

	public $view;

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
	}

	public function render() {
		return view('livewire.admin-student', [
			'plans' => User::find($this->userid)->allStudentPlan()->paginate(10),
		]);
	}
}
