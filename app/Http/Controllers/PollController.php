<?php

namespace App\Http\Controllers;

use App\Models\EncuestaSatisfaccion;
use App\Models\GanateSesion;
use App\Models\Cuestionario;
use Illuminate\Http\Request;
use Session as FlashSession;

class PollController extends Controller {

	public function encuesta_satisfaccion_index() {
		return view('poll.encuesta_satisfaccion');
	}

	public function encuesta_satisfaccion_store(Request $request) {
		return $request->all();
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
            'rut' => ['required', 'string', 'cl_rut'],
			'services-radio' => ['required'],
			'services' => ['required'],
			'satisfaction' => ['required'],
			'servicesinterest' => ['required'],
        ]);
		GanateSesion::create($input);
		FlashSession::flash('primary','Muchas gracias por tu respuesta');

		return redirect('/');
	}

	public function cuestionario_index() {
		return view('poll.cuestionario');
	}

	public function cuestionario_store(Request $request) {
		$input = request()->validate([
			'mail'  => ['required', 'string', 'email'],
			'P1' => ['required', 'string', 'max:255'],
			'P2' => ['string', 'max:255'],
			'P3' => ['string', 'max:255'],
			'P4' => ['required', 'string', 'max:255'],
			'P5' => ['string', 'max:255'],
			'P6' => ['string', 'max:255'],
			'P7' => ['required', 'string', 'max:255'],
			'P8' => ['string', 'max:255'],
			'P9' => ['string', 'max:255'],
			'P10' => ['required', 'string', 'max:255'],
			'P11' => ['string', 'max:255'],
			'P12' => ['string', 'max:255'],
			'P13' => ['required', 'string', 'max:255'],
			'P14' => ['string', 'max:255'],
			'P15' => ['string', 'max:255'],
			'P16' => ['required', 'string', 'max:255'],
			'P17' => ['required', 'string', 'max:255'],
			'P18' => ['required', 'string', 'max:255'],
			'P19' => ['required', 'string', 'max:255'],
			'P20' => ['required', 'string', 'max:255'],
			'P21' => ['required', 'string', 'max:255'],
			'PA' => ['required', 'string', 'max:255'],
			'Comment' => ['string', 'max:255'],
        ]);
		Cuestionario::create($input);
		FlashSession::flash('primary','Muchas gracias por tu respuesta');

		return redirect('/');
	}
}
