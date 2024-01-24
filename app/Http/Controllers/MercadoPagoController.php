<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\AppointmentMl;
// mercadopago
use MercadoPago\SDK;
use MercadoPago;

class MercadoPagoController extends Controller
{
    // public function index(){
    //     $token = config('services.mercadopago.public_token');

    //     $response = Http::withToken($token)->get("https://api.mercadopago.com/preapproval/search/", [
    //         'results.payer_email '=> '%%'
    //     ]);
    //     return $response;
    // }

    public function index(){
        $token = config('services.mercadopago.public_token');
        SDK::setAccessToken($token);

        $filters = [
            'range' => 'date_created',
            'begin_date' => 'NOW-1MONTH', // Ajusta el rango según tus necesidades
            'end_date' => 'NOW',
            'status' => 'approved',
            // Puedes añadir más filtros según lo necesites
        ];

        $paymentResult = MercadoPago\Payment::search($filters);

        ddd($paymentResult);
        
    }


    public function pay($id){
        $token = config('app.medilink');
        $client = new \GuzzleHttp\Client();

        $url = 'https://api.medilink.healthatom.com/api/v1/citas/'.$id;

        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $token
            ]
        ]);

        $appointment = json_decode($response->getBody())->data;
        // ddd($appointment);
        $id_atencion = $appointment->id_atencion;
        $client = new \GuzzleHttp\Client();
        $url = 'https://api.medilink.healthatom.com/api/v1/atenciones/'.$id_atencion;

        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $token
            ]
        ]);

        $atention = json_decode($response->getBody())->data;
        // ddd($atention->total);
        $id_paciente = $appointment->id_paciente;
        $url = 'https://api.medilink.healthatom.com/api/v1/pacientes/'.$id_paciente;

        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $token
            ]
        ]);

        $patient = json_decode($response->getBody())->data;

        return view('mercadopago.pay',compact('appointment','atention','patient'));
    }

    public function personalizepay(){
        return view('mercadopago.personalizepay');
    }
}
