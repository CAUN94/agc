<?php

namespace App\Http\Controllers;

use App\Models\AppointmentMl;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AdminMedilinkController extends Controller
{
    private $token;

    public function __construct()
    {
        $this->token = "WzpwZkzjncn1nyfvYx3VovEzTvpB2YSie4YPfvf1.8sggWtpBM3vzmAuE6aYAAmRYiAwxbXNIaM16oJ30";
    }

    public function index() {
        return 'Index';
    }

    public function profesionales() {
        $client = new \GuzzleHttp\Client();
        $url = 'https://api.medilink.healthatom.com/api/v1/profesionales/';

        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $this->token
            ]
        ]);

        echo $response->getBody();
    }

    public function profesional($id) {
        $client = new \GuzzleHttp\Client();
        $id_profesional = 2;
        $url = 'https://api.medilink.healthatom.com/api/v1/profesionales/'.$id;

        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $this->token
            ]
        ]);

        echo $response->getBody();
    }

    public function profesional_appointment($id) {
        $client = new \GuzzleHttp\Client();
        $id_profesional = 2;
        $url = 'https://api.medilink.healthatom.com/api/v1/profesionales/'.$id.'/citas?q={"fecha":{"gte":"2022-11-01"}}&sort=fecha:desc';

        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $this->token
            ]
        ]);

        $body = json_decode($response->getBody());
        $appointments = [];
        foreach($body->data as $data){
            $appointments[] = $data;
        }

        while(isset($body->links->next)){
            $url = $body->links->next;
            $response = $client->request('GET', $url, [
                'headers'  => [
                    'Authorization' => 'Token ' . $this->token
                ]
            ]);
            $body = json_decode($response->getBody());
            foreach($body->data as $data){
                $appointments[] = $data;
            }
        }
        return $appointments;
    }

    public function sucursales() {
        $client = new \GuzzleHttp\Client();
        $url = 'https://api.dentalink.healthatom.com/api/v1/sucursales/';

        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $this->token
            ]
        ]);

        echo $response->getBody();
    }

    public function citas() {
        $client = new \GuzzleHttp\Client();
        $url = 'https://api.dentalink.healthatom.com/api/v1/citas';
        $query_string   = '?q={"fecha":{"gt":"2022-12-01"}}';
        // $query_string   = '?q={"fecha":{"eq":"2022-12-07"}}';
        $url = $url."".$query_string;

        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $this->token
            ]
        ]);
        $body = json_decode($response->getBody());
        return $body;

        while(isset($body->links->next)){
            foreach ($body->data as $key => $data) {
                $url = 'https://api.medilink.healthatom.com/api/v1/pacientes/'.$data->id_paciente;

                $response = $client->request('GET', $url, [
                    'headers'  => [
                        'Authorization' => 'Token ' . $this->token
                    ]
                ]);

                $paciente = json_decode($response->getBody());
                // $url = 'https://api.medilink.healthatom.com/api/v1/pacientes/'.$data->id_paciente.'/convenios';

                // $response = $client->request('GET', $url, [
                //     'headers'  => [
                //         'Authorization' => 'Token ' . $this->token
                //     ]
                // ]);

                // $convenio = json_decode($response->getBody());

                // $appointmentMl = AppointmentMl::updateOrCreate(
                //     [
                //         'Tratamiento_Nr' => $data->id_tratamiento,
                //         'Rut_Paciente' => $paciente->data->rut,
                //     ],
                //     [
                //         'Estado' => $data->estado_cita,
                //         'Fecha' => $data->fecha,
                //         'Hora_inicio' => $data->hora_inicio,
                //         'Hora_termino' => $data->hora_fin,
                //         'Fecha_Generación' => $data->fecha_actualizacion,
                //         'Tratamiento_Nr' => $data->id_tratamiento,
                //         'Profesional' => $data->nombre_dentista,
                //         'Rut_Paciente' => $paciente->data->rut,
                //         'Nombre_paciente' => $paciente->data->nombre,
                //         'Apellidos_paciente' => $paciente->data->apellidos,
                //         'Mail' => $paciente->data->email,
                //         'Celular' => $paciente->data->celular,
                //         'Convenio' => '',
                //         'Sucursal' => 'You',
                //     ]
                // );
            }
            // ddd($appointmentMl);
            $url = $body->links->next;
            $response = $client->request('GET', $url, [
                'headers'  => [
                    'Authorization' => 'Token ' . $this->token
                ]
            ]);
            $body = json_decode($response->getBody());
        }
        return $body;


    }

    public function convenios() {
        $client = new \GuzzleHttp\Client();
        $url = 'https://api.dentalink.healthatom.com/api/v1/convenios';

        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $this->token
            ]
        ]);
        $body = $response->getBody();
        $body = json_decode($body);
        // ddd($body);
        return view('medilink',compact('body'));
    }

    public function convenios_cursor($cursor) {
        $client = new \GuzzleHttp\Client();
        $url = 'https://api.dentalink.healthatom.com/api/v1/convenios?cursor='.$cursor;

        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $this->token
            ]
        ]);
        $body = $response->getBody();
        $body = json_decode($body);
        // ddd($body);
        return view('medilink',compact('body'));
    }

    public function tratamientos() {
        $client = new \GuzzleHttp\Client();
        $url = 'https://api.dentalink.healthatom.com/api/v1/tratamientos/';

        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $this->token
            ]
        ]);

        echo $response->getBody();
    }

    public function atenciones() {
        $client = new \GuzzleHttp\Client();
        $url = 'https://api.medilink.healthatom.com/api/v1/atenciones/';

        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $this->token
            ]
        ]);

        echo $response->getBody();
    }




}
