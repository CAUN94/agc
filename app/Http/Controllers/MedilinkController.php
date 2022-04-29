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
    public function payments(){
        return PaymentMl::all();
    }
    public function actions(){
        return ActionML::all();
    }
    public function appointments(){
        return AppointmentML::all();
    }
    public function treatments(){
        return TreatmentML::all();
    }
}
