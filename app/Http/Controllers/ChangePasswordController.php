<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Session as FlashSession;
use Carbon\Carbon;

class ChangePasswordController extends Controller {

	public function __construct() {
		$this->middleware('auth');
	}

	public function index() {
		return view('auth.changePassword');
	}

	public function store(Request $request) {
		$request->validate([
			'current_password' => ['required', new MatchOldPassword],
			'new_password' => ['required', Rules\Password::defaults()],
			'new_confirm_password' => ['same:new_password'],
		]);
		// User::find(auth()->user()->id)->update(['password' => $request->new_password,'password_change_at' => Carbon::now()]);
		$user = User::find(auth()->user()->id);
		$user->password = $request->new_password;
		$user->password_change_at = Carbon::now();
		$user->save();
		FlashSession::flash('primary', 'Clave Actualizada');
		return redirect('/users');
	}
}
