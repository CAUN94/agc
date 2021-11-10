<?php

namespace App\Http\Livewire;

use App\Models\Training;
use Livewire\Component;

class SearchTrainPlan extends Component
{
    public $search = '';
    public $plan_id = '';
    public $plan = 'Selecciona un plan.';
    public $planClass = '';
    public $price = '';
    public $time = '';
    public $description = '';
    public $trainShow = false;
    public $openModal = false;
    public $trainings = [];
    public $coachs = [];

    public function showPlan(Training $training)
    {
        $this->plan_id = $training->id;
        $this->price = $training->price();
        $this->plan = $training->plan();
        $this->price = $training->price();
        $this->time = $training->time();
        $this->planClass = $training->planClassComplete();
        $this->description = $training->description;
        $this->coachs = ['Cata Coach','Panchito'];
        $this->trainShow = true;
    }

    public function updatedSearch($newValue)
    {
        $query = Training::query();
        $columns = ['name', 'class', 'time_in_minutes','format'];
        foreach($columns as $column){
            $query->orWhere($column, 'LIKE', '%' . $this->search . '%');
        }
        $this->trainings = $query->get();
    }

    public function render()
    {
        if($this->search === ''){
            $this->trainings = Training::all();
        }
        return view('livewire.search-train-plan');
    }
}
