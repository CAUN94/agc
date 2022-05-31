<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MercadoPagoController extends Controller
{
    public function index(){
        $token = config('services.mercadopago.public_token');
        // $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.mercadopago.com/preapproval/search']);
        // $headers = [
        //     'Authorization' => 'Bearer ' . $token,
        //     'Accept'        => 'application/json',
        // ];
        // $response = $client->request('GET', [
        //     'headers' => $headers
        // ]);

        // return $response;

        // $client = new \GuzzleHttp\Client();
        // $res = $client->request('GET', 'https://api.mercadopago.com/preapproval/search', [
        //     'Authorization' => 'Bearer APP_USR-8755092844165360-010413-cb65f6788c1353cbe5b277b0f853ca76-1050834774'
        // ]);
        // return $res;
        //

        $response = Http::withToken($token)->withHeaders(
            ['payer_email'  => 'pcarrascom@gmail.com']
        )->get("https://api.mercadopago.com/preapproval/search");
        return $response;
    }
}
