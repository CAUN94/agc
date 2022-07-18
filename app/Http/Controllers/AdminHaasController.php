<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminHaasController extends Controller
{
    public function nutrition(){
        return view('admin.haas.nutrition');
    }
}
