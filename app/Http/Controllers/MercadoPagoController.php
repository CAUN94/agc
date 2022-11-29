<?php

namespace App\Http\Controllers;

use App\Models\AppointmentMl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MercadoPagoController extends Controller
{
    public function index(){
        $token = config('services.mercadopago.public_token');

        $response = Http::withToken($token)->get("https://api.mercadopago.com/preapproval/search/", [
            'results.payer_email '=> 'pcarram@gmail.com'
        ]);
        return $response;
    }

    public function pay($id){
        $appointmentMl = AppointmentMl::where('Tratamiento_Nr',$id)->first();
        return view('mercadopago.pay',compact('appointmentMl'));
    }
}
