<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ClinicDataController extends Controller
{
    private $token;

    public function __construct()
    {
        $this->token = config('app.medilink');
    }
    public function index()
    {
        // use guzzle to get data from medilink
        // use this url 'https://api.medilink.healthatom.com/api/v1/pacientes/';
        $client = new \GuzzleHttp\Client();
        $url = 'https://api.medilink.healthatom.com/api/v1/pacientes/';

        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $this->token
            ]
        ]);

        $users = json_decode($response->getBody());
        
        $allusers[] = $users->data;
        while(isset($users->links->next)){
            $response = $client->request('GET', $users->links->next, [
                'headers'  => [
                    'Authorization' => 'Token ' . $this->token
                ]
            ]);
            $users = json_decode($response->getBody());
            $allusers[] = $users->data;
        }
        $allusers = array_merge(...$allusers);
        return view('admin.dataclinic.index',compact('allusers'));
    }

    public function show($id){
        $client = new \GuzzleHttp\Client();

        $id_paciente = $id;
        $url = 'https://api.medilink.healthatom.com/api/v1/pacientes/'.$id_paciente;

        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $this->token
            ]
        ]);

        $user =  json_decode($response->getBody())->data;


        return view('admin.dataclinic.show',compact('user'));
    }

    public function evolution($id){
        $client = new \GuzzleHttp\Client();

        $id_paciente = $id;
        $url = 'https://api.medilink.healthatom.com/api/v1/pacientes/'.$id_paciente;

        $response1 = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $this->token
            ]
        ]);

        $user =  json_decode($response1->getBody())->data;

        $url = 'https://api.medilink.healthatom.com/api/v1/pacientes/'.$id_paciente.'/evoluciones';
        $response2 = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $this->token
            ]
        ]);

        $evolutions =  json_decode($response2->getBody());

        return $evolutions;
        return view('admin.dataclinic.evolution',compact('user','evolutions'));
    }
}
