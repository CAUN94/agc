<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Useradmin extends Component
{
    public $users;
    public $user;

    public function mount()
    {
        $this->users = User::all();
    }


    public function render()
    {
        return view('livewire.useradmin');
    }
}
