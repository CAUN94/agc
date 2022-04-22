<?php

namespace App\Http\Controllers;

use App\Models\UserMl;
use Carbon\Carbon;
use Goutte\Client;
use Illuminate\Http\Request;
use Symfony\Component\HttpClient\HttpClient;

class ScrapingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create_client($url, $filter = False){
        $client = new Client();
        $crawler = $client->request('GET', 'https://youjustbetter.softwaremedilink.com/reportesdinamicos');
        $form = $crawler->selectButton('Ingresar')->form();
        $form->setValues(['rut' => 'admin', 'password' => 'Pascual4900']);
        $crawler = $client->submit($form);
        if($filter){
            $first = strval(Carbon::create(null, null, null)->subMonth()->subMonth()->format('Y-m-d'));
            $last = strval(Carbon::create(null, null, null)->addMonth()->format('Y-m-d'));
            $url = $url."%5Bfecha_inicio%5D%5Bstatus%5D=activated&filters%5Bfecha_inicio%5D%5Bvalue%5D=".$first."&filters%5Bfecha_fin%5D%5Bstatus%5D=activated&filters%5Bfecha_fin%5D%5Bvalue%5D=".$last."";
        }
        $crawler = $client->request('GET', $url);
        $array = $crawler->text();
        $array = substr($array,2,-2);
        $split = explode('},{', $array);
        return $split;
    }

    public function userMl(){

        $split = self::create_client("https://youjustbetter.softwaremedilink.com/reportesdinamicos/reporte/pacientes_nuevos");
        // return $split;
        $count = 0;
        foreach($split as $string){
            $jsonobj = "{".$string."}";
            $value = json_decode($jsonobj,true);
            $userMl = UserMl::updateOrCreate(
                ['RUT' => $value['RUT/DNI'],'Email' => $value['E-Mail']],
                [
                    'Nombre' => $value['Nombre paciente'],
                    'Apellidos' => $value['Apellidos paciente'],
                    'Fecha_Ingreso' => $value['Fecha Afiliación'],
                    'Ultima_Cita' => $value['Última Cita'],
                    'RUT' => $value['RUT/DNI'],
                    'Nacimiento' => $value['Fecha nacimiento'],
                    'Celular' => $value['Celular'],
                    'Ciudad' => $value['Ciudad'],
                    'Comuna' => $value['Comuna'],
                    'Direccion' => $value['Dirección'],
                    'Email' => $value['E-Mail'],
                    'Observaciones' => $value['Observaciones'],
                    'Sexo' => $value['Sexo'],
                    'Convenio' => $value['Convenio']
                ]
            );
            $count++;
            if($count == 100){
                break;
            }
        }
        return redirect('/userml');
    }

    public function professionals(){
        $professionals = self::create_client("https://youjustbetter.softwaremedilink.com/dentistas/autocomplete");
        return view('professionalsml.index',compact('professionals'));
    }

    public function professional($id){
        $client = new Client();
        $crawler = $client->request('GET', 'https://youjustbetter.softwaremedilink.com/reportesdinamicos');
        $form = $crawler->selectButton('Ingresar')->form();
        $form->setValues(['rut' => 'admin', 'password' => 'Pascual4900']);
        $crawler = $client->submit($form);
        $now = Carbon::now();
        $weekStartDate = $now->startOfWeek()->format('Y-m-d');
        $url = "https://youjustbetter.softwaremedilink.com/agendas/semanalJSON/".$weekStartDate."/?id_profesional=".$id;

        $crawler = $client->request('GET', $url);
        $professional = $crawler->text();
        $professional = json_decode($professional,true);
        $professionals = self::create_client("https://youjustbetter.softwaremedilink.com/dentistas/autocomplete");
        foreach($professionals as $names){
            $value = json_decode("{".$names."}",true);
            if($value['id'] == $id){
                break;
            }
        }
        // return $professional;
        return view('professionalsml.show',compact('professional','value'));
    }

    public function actionMl(){
        return self::create_client("https://youjustbetter.softwaremedilink.com/reportesdinamicos/reporte/listado_acciones?filters%5Bsucursal%5D%5Bstatus%5D=activated&filters%5Bsucursal%5D%5Bvalue%5D=1&filters",true);
        // return $array;
    }

    public function appointmentMl(){
        return self::create_client("https://youjustbetter.softwaremedilink.com/reportesdinamicos/reporte/citas?filters%5Bsucursal%5D%5Bstatus%5D=activated&filters%5Bsucursal%5D%5Bvalue%5D=1&filters",true);
        // return $array;
    }

    public function treatmentsMl(){
        return self::create_client("https://youjustbetter.softwaremedilink.com/reportesdinamicos/reporte/resumen_tratamientos_saldos");
        // return $array;
    }

    public function paymentsMl(){
        return self::create_client("https://youjustbetter.softwaremedilink.com/reportesdinamicos/reporte/pagos_pacientes");
        // return $array;
    }
}
