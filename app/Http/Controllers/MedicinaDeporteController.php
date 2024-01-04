<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class MedicinaDeporteController extends Controller
{
    public function index()
    {
        return view('admin.medicinaDeporte.index');
    }

    public function pdf(Request $request)
    {
        $data = $request->all();
        $datos = $data['datos'];
        $pdf = PDF::loadView('admin.medicinaDeporte', compact('datos'));
        return $pdf->download('medicinaDeporte.pdf');
    }
}
