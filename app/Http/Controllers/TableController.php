<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function __construct()
    {
        $this->middleware('student')->only(['index']);
    }

    public function index()
    {
        return view('tables.index');
    }
}
