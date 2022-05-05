<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActionMl;
use App\Models\AppointmentMl;
use App\Models\PaymentMl;
use App\Models\TreatmentMl;
use App\Models\UserMl;

class MedilinkController extends Controller
{
    public function __construct() {
        $this->middleware('intranet');
    }

    public function payments(){
        return view('admin.medilink.payments');
    }
    public function actions(){
        return view('admin.medilink.actions');
    }
    public function appointments(){
        return view('admin.medilink.appointments');
    }
    public function treatments(){
        return view('admin.medilink.treatments');
    }
}
