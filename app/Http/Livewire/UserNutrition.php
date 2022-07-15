<?php

namespace App\Http\Livewire;

use App\Models\Nutrition;
use Livewire\Component;

class UserNutrition extends Component
{
    public $user;
    public $nutrition;
    public $nutritionID;
    public $date;

    public function mount($user){
        $this->user = $user;
        $this->nutrition = Nutrition::orderBy('fecha', 'desc')->first();;
    }

    public function updatedNutritionId()
    {
        $this->nutrition = Nutrition::find($this->nutritionID);
    }


    public function render()
    {
        return view('livewire.user-nutrition');
    }
}
