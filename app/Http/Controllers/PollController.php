<?php

namespace App\Http\Controllers;

use App\Models\EncuestaSatisfaccion;
use App\Models\GanateSesion;
use Illuminate\Http\Request;
use Session as FlashSession;

class PollController extends Controller {

	public function encuesta_satisfaccion_index() {
		return view('poll.encuesta_satisfaccion');
	}

	public function encuesta_satisfaccion_store(Request $request) {
		$input = request()->validate([
            'rut' => ['required', 'string', 'cl_rut'],
            'pain' => 'required',
            'satisfaction' => 'required',
            'experience' => 'required',
            'friend' => 'required',
            'comment' => 'nullable',
            'gustos' => 'required'
        ]);
		EncuestaSatisfaccion::create($input);


		FlashSession::flash('primary','Muchas gracias por tu respuesta');

		return redirect('/');
	}

	public function ganate_una_sesion_index() {
		return view('poll.ganate_una_sesion');
	}

	public function ganate_una_sesion_store(Request $request) {
		$input = request()->validate([
            'mail' => ['required', 'email'],
            'gustos' => ['required']
        ]);
		GanateSesion::create($input);


		FlashSession::flash('primary','Muchas gracias por tu respuesta');

		return redirect('/');
	}
}
