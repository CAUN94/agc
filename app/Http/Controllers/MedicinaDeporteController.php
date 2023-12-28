<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MedicinaDeporteController extends Controller
{
    public function index()
    {
        return view('medicinaDeporte.index');
    }
}
