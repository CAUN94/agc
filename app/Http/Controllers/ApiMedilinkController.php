<?php

namespace App\Http\Controllers;

use App\Models\AppointmentMl;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiMedilinkController extends Controller
{
    private $token;

    public function __construct()
    {
        $this->token = "WzpwZkzjncn1nyfvYx3VovEzTvpB2YSie4YPfvf1.8sggWtpBM3vzmAuE6aYAAmRYiAwxbXNIaM16oJ30";
    }

    public function professionals()
    {
        $client = new \GuzzleHttp\Client();
        $url = 'https://api.medilink.healthatom.com/api/v1/profesionales/';

        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $this->token
            ]
        ]);

        echo $response->getBody();
    }

    public function atentions()
    {
        $client = new \GuzzleHttp\Client();
        $query_string   = '?q={"fecha":{"gt":"2022-12-26"}}';
        $url = 'https://api.medilink.healthatom.com/api/v1/atenciones';
        $url = $url."".$query_string;
        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $this->token
            ]
        ]);

        echo $response->getBody();
    }

    public function allAtentions()
    {
        $client = new \GuzzleHttp\Client();
        $query_string   = '?q={"fecha":{"gt":"2022-11-01"}}';
        $url = 'https://api.medilink.healthatom.com/api/v1/atenciones';
        $url = $url."".$query_string;

        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $this->token
            ]
        ]);

        $allAtentions = [];
        $atentions = json_decode($response->getBody());
        $allAtentions[] = $atentions->data;
        
        while(isset($atentions->links->next)){
            $response = $client->request('GET', $atentions->links->next, [
                'headers'  => [
                    'Authorization' => 'Token ' . $this->token
                ]
            ]);
            $atentions = json_decode($response->getBody());
            $allAtentions[] = $atentions->data;
            
        }
        return array_merge(...$allAtentions);
    }

    public function appointments()
    {
        $client = new \GuzzleHttp\Client();

        $query_string   = '?q={"fecha":{"gt":"2022-08-01"}}';
        $url = 'https://api.medilink.healthatom.com/api/v1/citas';
        $url = $url."".$query_string;

        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $this->token
            ]
        ]);

        echo $response->getBody();
    }

    public function allAppointments()
    {
        $client = new \GuzzleHttp\Client();

        $query_string   = '?q={"fecha":{"gt":"2022-08-01"},"estado_cita":{"eq":"Atendido"}}';
        $url = 'https://api.medilink.healthatom.com/api/v1/citas';
        $url = $url."".$query_string;

        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $this->token
            ]
        ]);

        $allAppointments = [];
        $appointments = json_decode($response->getBody());
        $allAppointments[] = $appointments->data;
        
        while(isset($appointments->links->next)){
            $response = $client->request('GET', $appointments->links->next, [
                'headers'  => [
                    'Authorization' => 'Token ' . $this->token
                ]
            ]);
            $appointments = json_decode($response->getBody());
            $allAppointments[] = $appointments->data;
            
        }
        return array_merge(...$allAppointments);
    }
}
