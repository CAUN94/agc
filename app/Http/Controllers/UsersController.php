<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session as FlashSession;

class UsersController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$user = Auth::user();
		return view('users.show', compact('user'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return abort(404);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function show(User $user) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function edit(User $user) {
		if (auth()->user()->id !== $user->id) {
			abort(401);
		}
		return view('users.edit', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, User $user) {
		$attributes = $request->validate([
			'name' => ['required', 'string', 'max:255'],
			'lastnames' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255'],
			'gender' => ['required', 'string', 'min:1', 'max:1', 'in:m,f,n'],
			'rut' => ['required', 'string', 'cl_rut'],
			'phone' => ['required', 'string', 'max:255'],
			'birthday' => ['required', 'date', 'before:tomorrow', 'after:1900-01-91'],
			'profile' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
			'description' => ['nullable', 'string'],
			'address' => ['nullable', 'string'],
		]);

		$user->name = $attributes['name'];
		$user->lastnames = $attributes['lastnames'];
		$user->email = $attributes['email'];
		$user->gender = $attributes['gender'];
		$user->rut = $attributes['rut'];
		$user->phone = $attributes['phone'];
		$user->birthday = $attributes['birthday'];
		if ($request->profile != Null) {
			$path = $attributes['profile']->storePublicly('public/profiles');
			$user->profile = $path;
		}
		$user->description = $attributes['description'];
		$user->address = $attributes['address'];
		$user->save();
		FlashSession::flash('primary', $user->name . " se actualizo tu perfil");
		return redirect('/users');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(User $user) {
		if (auth()->user()->id !== $user->id) {
			abort(401);
		}

		$user->delete();
		return redirect('/');
	}
}
