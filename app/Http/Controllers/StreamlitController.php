<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class StreamlitController extends Controller
{
    public function index()
    {
        return view('streamlit.index');
    }
}
