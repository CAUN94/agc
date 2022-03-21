<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;

class ScrapingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create_client($url, $filer = False){
        $client = new Client();
        $crawler = $client->request('GET', 'https://youjustbetter.softwaremedilink.com/reportesdinamicos');
        $form = $crawler->selectButton('Ingresar')->form();
        $form->setValues(['rut' => 'admin', 'password' => 'Pascual4900']);
        $crawler = $client->submit($form);
        $first = strval(Carbon::create(null, null, null)->subMonth()->subMonth()->format('Y-m-d'));
        $last = strval(Carbon::create(null, null, null)->addMonth()->addMonth()->format('Y-m-d'));
        $url = $url;
        $crawler = $client->request('GET', $url);
        $array = $crawler->text();
        return $array;
        $array = substr($array,2,-2);
        $split = explode('},{', $array);
        return $split;
    }

    public function userMl(){
        return self::create_client("https://youjustbetter.softwaremedilink.com/reportesdinamicos/reporte/pacientes_nuevos");

        // return $array;
    }
}
