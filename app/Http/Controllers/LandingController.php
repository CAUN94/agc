<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function welcome()
    {
        return view('welcome');
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

    public function tables()
    {
        return view('tables');
    }

    public function example(){
        return view('example');
    }


}
