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
}
