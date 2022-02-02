<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PollController extends Controller {

	public function example() {
		return view('poll.example');
	}

	public function showdata(Request $request) {
		request()->validate([
			'rut' => 'required',
			'pain' => 'required',
			'satisfaction' => 'required',
			'experience' => 'required',
			'friend' => 'required',
			'comment' => 'nullable',
		]);
		dd($request->all());
	}
}
