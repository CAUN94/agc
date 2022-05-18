<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Alliance;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

class AdminUser extends Component {

	use WithFileUploads;

	public $user;
	public $name;
	public $lastnames;
	public $rut;
	public $gender;
	public $email;
	public $phone;
	public $birthday;
	public $address;
	public $profile;
	public $description;
	public $userid;
	public $view;
	public $new_profile;
	public $alliance;
	public $desc;
	public $allAlliance;
	public $newalliance;

	public function mount($user) {
		$this->name = $user->name;
		$this->lastnames = $user->lastnames;
		$this->rut = $user->rut;
		$this->gender = $user->gender;
		$this->email = $user->email;
		$this->phone = $user->phone;
		$this->birthday = $user->birthday;
		$this->address = $user->address;
		$this->profile = $user->profilepic();
		$this->description = $user->description;
		$this->view = '';
		$this->userid = $user->id;
		if($user->hasAlliance()){
			$this->alliance = $user->alliance()->name;
			$this->desc = $user->alliance()->desc;
		}
		else {
			$this->alliance = null;
			$this->desc = null;
		}
		$this->allAlliance = Alliance::where('id','>','1')->orderby('name','asc')->get();

	}

	public function storeAlliance() {
		$validatedData = $this->validate([
			'newalliance' => ['required']
		]);

		$pivot = DB::table('users_alliances_pivot')->updateOrInsert(
			['user_id' => $this->userid],
            ['alliance_id' => $validatedData['newalliance']
        ]);

		if($this->user->hasAlliance()){
			$this->alliance = $this->user->alliance()->name;
			$this->desc = $this->user->alliance()->desc;
		}
		else {
			$this->alliance = null;
			$this->desc = null;
		}
		session()->flash('primary', 'Alianza Cargada');
	}

	public function deleteUser() {
		User::find($this->userid)->delete();
		return redirect()->to('/adminusers');
	}

	public function activateEdit() {
		$this->view = 'edit';
	}

	public function unActivateEdit() {
		$this->view = '';
	}

	public function update() {
		$validatedData = $this->validate([
			'name' => ['required', 'string', 'max:255'],
			'lastnames' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255'],
			'gender' => ['required', 'string', 'min:1', 'max:1', 'in:m,f,n'],
			// 'rut' => ['required', 'string', 'unique:users'],
			// 'rut' => ['required', 'string', 'cl_rut'],
			'phone' => ['required', 'string', 'max:255'],
			'birthday' => ['required', 'date', 'before:tomorrow', 'after:1900-01-91'],
			// 'profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
			// 'description' => ['string'],
		]);

		$user = User::find($this->userid);
		$user->name = $this->name;
		$user->lastnames = $this->lastnames;
		$user->rut = $this->rut;
		$user->gender = $this->gender;
		$user->email = $this->email;
		$user->phone = $this->phone;
		$user->birthday = $this->birthday;
		$user->address = $this->address;
		if ($this->new_profile != Null) {
			$path = $this->new_profile->storePublicly('public/profiles');
			$user->profile = $path;
		}
		$user->description = $this->description;
		$user->save();
		$this->view = '';
		session()->flash('primary', 'Usuario Actualizado.');

		return redirect()->to('/adminusers/' . $this->userid);
	}

	public function render() {
		return view('livewire.admin-user');
	}

}
