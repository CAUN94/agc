<?php

namespace App\Http\Controllers;
use App\Models\Nutrition;
use Illuminate\Http\Request;

class AdminHaasController extends Controller
{
    public function nutrition(){
        return view('admin.haas.nutrition');
    }

    public function pdf(){
      $nutrition = Nutrition::latest()->first();
      $pdf = Pdf::loadView('livewire.pdf', compact('nutrition'));
      return $pdf->stream('livewire.pdf');
    }
}
