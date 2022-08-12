<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminNuboxController extends Controller
{
    public function nubox(){

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.nubox.com/nubox.api/autenticar",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_HTTPHEADER => array(
        "Authorization: Basic aDBWNzcyTEJEUHJkOjNzd3EuYzU3"
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
    }
}
