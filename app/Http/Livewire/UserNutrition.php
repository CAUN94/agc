<?php

namespace App\Http\Livewire;

use App\Models\Nutrition;
use Livewire\Component;
use App\Models\NutritionDocuments;
use Barryvdh\DomPDF\Facade\Pdf;

class UserNutrition extends Component
{
    public $user;
    public $nutrition;
    public $nutritionID;
    public $date;
    public $masa_adiposa_previa;
    public $masa_muscular_previa;

    public function mount($user){
        $this->user = $user;
        $this->nutrition = Nutrition::where('rut',$user->rut)->orderBy('fecha', 'desc')->first();
        $this->nutritionID = $this->nutrition->id;
    }

    public function updatedNutritionId()
    {
        $this->nutrition = Nutrition::find($this->nutritionID);
        $sesion_pasada = Nutrition::where('rut',$nutrition->rut)->where('fecha','<',$nutrition->fecha)->orderBy('fecha','desc')->first();
    }

    public function createNutrinion(){}

    public function pdf()
    {
        $nutrition = Nutrition::find($this->nutritionID);

        $pdfContent = PDF::loadView('livewire.pdf', compact('nutrition'))->output();
        return response()->streamDownload(
             fn () => print($pdfContent),
             "Evaluacion_Nutricional.pdf"
        );
    }

    public function render()
    {
        return view('livewire.user-nutrition');
    }
}
