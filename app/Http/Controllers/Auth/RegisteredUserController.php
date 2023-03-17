<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\AdminNewUser;
use App\Mail\WelcomeNewUser;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Session as FlashSession;
use Freshwork\ChileanBundle\Rut;

class RegisteredUserController extends Controller {
	/**
	 * Display the registration view.
	 *
	 * @return \Illuminate\View\View
	 */
	public function create() {
		return view('auth.register');
	}

	/**
	 * Handle an incoming registration request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\RedirectResponse
	 *
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function store(Request $request) {
		$requestData = $request->all();
		if(Rut::parse($requestData['rut'])->quiet()->validate()){
			$requestData = $request->all();
		    $requestData['rut'] = strtolower(Rut::parse(Rut::parse($requestData['rut'])->normalize())->format(Rut::FORMAT_WITH_DASH));
		    $request->replace($requestData);

		    if(User::where('rut',$requestData['rut'])->first() != null){

		    	$user = User::where('rut',$requestData['rut'])->first();
		    	$user->password = $requestData['rut'];
		    	$user->password_change_at = Null;
		    	$user->save();
		    	FlashSession::flash('primary', 'Usuario ya registrado');
		    	return redirect('/login');
		    }
        }

		$attributes = $request->validate([
			'name' => ['required', 'string', 'max:255'],
			'lastnames' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255'],
			'gender' => ['required', 'string', 'min:1', 'max:1', 'in:m,f,n'],
			// 'rut' => ['required', 'string', 'unique:users'],
			'rut' => ['required', 'string', 'cl_rut', 'unique:users'],
			'phone' => ['required', 'string', 'max:255'],
			'birthday' => ['required', 'date', 'before:tomorrow', 'after:1900-01-91'],
			'password' => ['required', 'confirmed', Rules\Password::defaults()],
		]);

		$user = User::create($attributes);
		$user->password_change_at = $user->created_at;
		$user->save();

		event(new Registered($user));

		Auth::login($user);

		FlashSession::flash('primary', 'Hola ' . Auth::user()->name);

		\Mail::to($user->email)->send(new WelcomeNewUser($user));
		\Mail::to('desarrollo@justbetter.cl')->bcc('clinica@justbetter.cl')->bcc('you@justbetter.cl')->send(new AdminNewUser($user));

		return redirect(RouteServiceProvider::HOME);
	}
}
