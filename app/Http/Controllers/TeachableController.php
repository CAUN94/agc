<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeachableController extends Controller
{
    public function getCourses()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://yourschool.teachable.com/api/v1/courses', [
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode($apiKey . ':')
            ]
        ]);
        $courses = json_decode($response->getBody());

    }
}
