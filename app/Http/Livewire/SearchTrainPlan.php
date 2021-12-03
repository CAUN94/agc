<?php

namespace App\Http\Livewire;

use App\Models\Training;
use Livewire\Component;

class SearchTrainPlan extends Component
{
    public $search = '';
    public $plan = 'Selecciona un plan.';
    public $trainShow = false;
    public $openModal = false;
    public $selectedTraining = [];
    public $trainings = [];
    public $coachs = ['Panchito','Cata Coach'];

    public function mount(){
        $this->selectedTraining = Training::first();
    }

    public function showPlan(Training $training)
    {
        $this->selectedTraining= $training;
        $this->trainShow = true;
    }

    public function updatedSearch($newValue)
    {
        $query = Training::query();
        $columns = ['name','time_in_minutes','class','format'];
        foreach($columns as $column){
            $query->orWhere($column, 'LIKE', '%' . $this->search . '%');
        }
        $this->trainings = $query->groupby('format','name')->orderby('name','asc')->get();
    }

    public function render()
    {
        // if($this->trainShow!=''){
        //     ddd($this->trainShow);
        // }
        if($this->search === ''){
            $this->trainings = Training::groupby('format','name')->orderby('name','asc')->get();
        }
        return view('livewire.search-train-plan');
    }
}
