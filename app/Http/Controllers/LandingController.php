<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session as FlashSession;

class LandingController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function about()
    {
        return view('about');
    }

    public function terms()
    {
        return redirect('/pdf/tyc.pdf');
    }

    public function team()
    {
        $team = [
            [
                'name' => 'Alonso Niklitschek',
                'img' => '/img/equipo/alonso.jpg',
                'info' => '<li>Kinesiologia, Universidad Mayor, 2014</li><li>Diplomado en Terapia Manual, Universidad de Chile, 2016</li><li>Diplomado en Terapia Manual, Universidad de Chile, 2016</li><li>Cursando Magister en Terapias Ortopédicas, Universidad Andrés Bello</li>'
            ]
        ];
        return view('team',compact('team'));
    }

    public function calendar(){
        $user = Auth::user();
        return view('users.calendar',compact('user'));
    }

    public function healthy(){
        $user = Auth::user();
        return view('users.healthy',compact('user'));
    }

    public function nutrition(){
        $user = Auth::user();
        return view('users.nutrition',compact('user'));
    }

    public function packverano()
    {
        return view('packverano');
    }

    public function mailverano(Request $request)
    {
        $details = [
            'name' => $request->name,
            'phone' => $request->phone,
            'pack' => $request->pack,
         ];
        \Mail::to('cristobalugarte6@gmail.com')->send(new \App\Mail\PackVerano($details));

        FlashSession::flash('primary', 'Inscripción Lista');
        return redirect('/packverano');
    }

    public function tables()
    {
        return view('tables');
    }

    public function example(){
        return view('example');
    }

    public function renew()
    {
        return view('users.renew');
    }


}
