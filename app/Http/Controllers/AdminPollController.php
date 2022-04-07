<?php

namespace App\Http\Controllers;

use App\Models\EncuestaSatisfaccion;
use App\Models\GanateSesion;
use Illuminate\Http\Request;
use Session as FlashSession;


class AdminPollController extends Controller
{
    public function __construct() {
        $this->middleware('intranet');
    }

    public function encuesta_satisfaccion_index() {
        return view('adminpoll.encuesta_satisfaccion');
    }
}
