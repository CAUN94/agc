<?php

namespace App\Http\Livewire;

use App\Models\Nutrition;
use Livewire\Component;
use App\Models\NutritionDocuments;

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

    public function createNutrinion(){}

    public function descargarPDF($fecha,$rut)
    {
        $pdf = NutritionDocuments::where('fecha',$fecha)->where('rut_paciente',$rut)->first();

        if (!$pdf) {
          return redirect()->back()->with('error', 'El PDF no se encuentra.');
        }
        return response()->streamDownload(function () use ($pdf) {
                      echo $pdf->pdf;
                  }, "Evaluacion_nutricional.pdf", ['Content-Type' => 'application/pdf']);;
    }

    public function render()
    {
        return view('livewire.user-nutrition');
    }
}
