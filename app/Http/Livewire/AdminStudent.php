<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AdminStudent extends Component {

	use WithPagination;

	public $view;

	public function mount($student) {
		$this->name = $student->user->name;
		$this->lastnames = $student->user->lastnames;
		$this->rut = $student->user->rut;
		$this->gender = $student->user->gender();
		$this->email = $student->user->email;
		$this->phone = $student->user->phone;
		$this->birthday = $student->user->birthday;
		$this->address = $student->user->address;
		$this->profile = $student->user->profilepic();
		$this->description = $student->user->description;
		$this->view = '';
		$this->userid = $student->user->id;
		$this->view = '';
	}

	public function render() {
		return view('livewire.admin-student', [
			'plans' => User::find($this->userid)->allStudentPlan()->paginate(10),
		]);
	}
}
