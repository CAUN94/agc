<?php

namespace App\Http\Controllers;

use App\Models\Alliance;
use Illuminate\Http\Request;

class AdminAllianceController extends Controller
{
    function index(){
        return view('admin.alliance.index');
    }
}
