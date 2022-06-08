<?php

namespace App\Http\Controllers;

use App\Models\Alliance;
use Illuminate\Http\Request;
use Session as FlashSession;

class AdminAllianceController extends Controller
{
    function index(){
        return view('admin.alliance.index');
    }

    function store(Request $request){

        $validated = $request->validate([
            'name' => 'required',
            'desc' => 'required|numeric',
        ]);
        $alliance = new Alliance;
        $alliance->name = $request->name;
        $alliance->desc = $request->desc;
        $alliance->save();

        FlashSession::flash('primary', 'Alianza Creada');
        return view('admin.alliance.index');
    }
}
