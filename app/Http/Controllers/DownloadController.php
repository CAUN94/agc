<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function downloadTyC()
    {
        return response()->download("/public/pdf/TÉRMINOS Y CONDICIONES DEL SERVICIO DE ENTRENAMIENTO.pdf");
    }
}
