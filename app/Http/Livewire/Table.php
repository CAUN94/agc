<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public $search = '';

    public function mount()
    {

    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = User::query();
        $columns = ['name', 'lastnames', 'rut','gender','email','phone','birthday'];
        foreach($columns as $column){
            $query->orWhere($column, 'LIKE', '%' . $this->search . '%');
        }
        return view('livewire.useradmin',[
            'users' => $query->paginate(20),
        ]);
    }
}
