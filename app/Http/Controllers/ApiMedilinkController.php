<?php

namespace App\Http\Controllers;

use App\Models\AppointmentMl;
use App\Models\User;
use GuzzleHttp\Client;
use App\Models\actionMl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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

        $query_string   = '?q={"fecha":{"gt":"2022-12-30"}}';
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

        $query_string   = '?q={"fecha":{"gt":"2022-08-01"}}';
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

        foreach ($appointments->data as $appointment) {

          if($a->finalizado=1){
            $estado = 'Atendido';
          }else{
            $estado = 'No Atendido';
          }

          if(empty($action->convenio)){
            $action->convenio = 'Sin Convenio';
          }

          $nombre = strtok($appointment->nombre_paciente,  ' ');
          $apellido = substr($appointment->nombre_paciente, strpos($appointment->nombre_paciente, " ") + 1);

            $new_row = AppointmentMl::create([
              'id'=> $action->id,
              'Estado'=> $estado,
              'Fecha'=> $action->fecha,
              'Profesional'=> $action->nombre_profesional,
              'Nombre'=>$nombre,
              'Apellido'=>$apellido,
              'Categoria_Nr' => $action->id_tipo,
              'Categoria_Nombre'=> $action->nombre_tipo,
              'Tratamiento_Nr'=> $action->id,
              'Convenio'=> $action->nombre_convenio,
              'Prestacion_Nr'=> $action->id,
              'Prestacion_Nombre'=> $action->nombre_tipo,
              'Precio_Prestacion'=> $action->total,
              'Abono'=> $action->abonado,
              'Total'=> $action->total_realizado,
              'Sucursal'=> $action->nombre_sucursal,
              'created_at'=> Carbon::Now(),
              'updated_at'=> Carbon::Now()
            ]);
          $new_row->save();
        }

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

<<<<<<< HEAD
    public function estado()
    {
        $client = new \GuzzleHttp\Client();

        $query_string   = '?q={"fecha":{"gt":"2022-08-01"}}';
        $url = 'https://api.medilink.healthatom.com/api/v1/citas';
=======
    public function allActions()
    {
        $client = new \GuzzleHttp\Client();

        $query_string   = '?q={"fecha":{"gt":"2022-09-01"}}';
        $url = 'https://api.medilink.healthatom.com/api/v1/atenciones/';
>>>>>>> 9589e7c1b3b8055fe4a4bc02427c9ab7b00ac4c7
        $url = $url."".$query_string;

        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $this->token
            ]
        ]);

<<<<<<< HEAD
        echo $response->getBody();
=======
        $allActions = [];
        $actions = json_decode($response->getBody());
        $allActions[] = $actions->data;

        foreach ($actions->data as $action) {

          if($action->finalizado=1){
            $estado = 'Atendido';
          }else{
            $estado = 'No Atendido';
          }

          if(empty($action->convenio)){
            $action->convenio = 'Sin Convenio';
          }

          $nombre = strtok($action->nombre_paciente,  ' ');
          $apellido = substr($action->nombre_paciente, strpos($action->nombre_paciente, " ") + 1);

            $new_row = actionMl::create([
              'id'=> $action->id,
              'Sucursal'=> $action->nombre_sucursal,
              'Nombre'=>$nombre,
              'Apellido'=>$apellido,
              'Categoria_Nr' => $action->id_tipo,
              'Categoria_Nombre'=> $action->nombre_tipo,
              'Tratamiento_Nr'=> $action->id,
              'Profesional'=> $action->nombre_profesional,
              'Estado'=> $estado,
              'Convenio'=> $action->nombre_convenio,
              'Prestacion_Nr'=> $action->id,
              'Prestacion_Nombre'=> $action->nombre_tipo,
              'Fecha_Realizacion'=> $action->fecha,
              'Precio_Prestacion'=> $action->total,
              'Abono'=> $action->abonado,
              'Total'=> $action->total_realizado,
              'created_at'=> Carbon::Now(),
              'updated_at'=> Carbon::Now()
            ]);
          $new_row->save();
        }

        while(isset($actions->links->next)){
            $response = $client->request('GET', $actions->links->next, [
                'headers'  => [
                    'Authorization' => 'Token ' . $this->token
                ]
            ]);
            $actions = json_decode($response->getBody());
            $allActions[] = $actions->data;

            foreach ($actions->data as $action) {

              if($action->finalizado=1){
                $estado = 'Atendido';
              }else{
                $estado = 'No Atendido';
              }

              if($action->convenio=""){
                $action->convenio = 'Sin Convenio';
              }

              $nombre = strtok($action->nombre_paciente,  ' ');
              $apellido = substr($action->nombre_paciente, strpos($action->nombre_paciente, " ") + 1);

                $new_row = actionMl::create([
                  'id'=> $action->id,
                  'Sucursal'=> $action->nombre_sucursal,
                  'Nombre'=>$nombre,
                  'Apellido'=>$apellido,
                  'Categoria_Nr' => $action->id_tipo,
                  'Categoria_Nombre'=> $action->nombre_tipo,
                  'Tratamiento_Nr'=> $action->id,
                  'Profesional'=> $action->nombre_profesional,
                  'Estado'=> $estado,
                  'Convenio'=> $action->nombre_convenio,
                  'Prestacion_Nr'=> $action->id,
                  'Prestacion_Nombre'=> $action->nombre_tipo,
                  'Fecha_Realizacion'=> $action->fecha,
                  'Precio_Prestacion'=> $action->total,
                  'Abono'=> $action->abonado,
                  'Total'=> $action->total_realizado,
                  'created_at'=> Carbon::Now(),
                  'updated_at'=> Carbon::Now()
                ]);
              $new_row->save();
            }
        }

        return array_merge(...$allActions);
>>>>>>> 9589e7c1b3b8055fe4a4bc02427c9ab7b00ac4c7
    }
}
