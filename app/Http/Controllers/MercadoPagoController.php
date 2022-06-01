<?php

namespace App\Http\Controllers;

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
}
