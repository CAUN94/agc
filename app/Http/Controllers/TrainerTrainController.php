<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainerTrainController extends Controller
{
    public function __construct() {
        $this->middleware('intranet');
    }

    public function index()
    {
        return view('admin.trainers.trainAppointments.index');
    }
}
