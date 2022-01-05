<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AdminUser extends Component
{
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

    public $view;

    public function mount($user)
    {
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
    }

    public function render()
    {
        return view('livewire.admin-user');
    }

    public function activateEdit()
    {
        $this->view = 'edit';
    }

    public function unactivateEdit()
    {
        $this->view = '';
    }

    public function update()
    {
        ddd($this);
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'lastnames' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'gender' => ['required', 'string', 'min:1' , 'max:1', 'in:m,f,n'],
            // 'rut' => ['required', 'string', 'unique:users'],
            'rut' => ['required', 'string', 'cl_rut'],
            'phone' => ['required', 'string', 'max:255'],
            'birthday' => ['required', 'date'],
            'address' => ['string'],
            'description' => ['string']
        ]);
    }


}
