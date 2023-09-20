<?php

namespace App\Http\Controllers;

use App\Models\AppointmentMl;
use App\Models\Professional;
use App\Models\Payment;
use App\Models\User;
use GuzzleHttp\Client;
use Google\Client as GoogleClient;
use GuzzleHttp\Exception\ClientException;
use App\Models\actionMl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;
use Google\Service\Calendar;
use Google_Service_Calendar_Event;

class ApiMedilinkController extends Controller
{
    private $token;

    public function __construct()
    {
        $this->token = config('app.medilink');
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

    public function professional($rut){
      $client = new \GuzzleHttp\Client();
      $url = 'https://api.medilink.healthatom.com/api/v1/profesionales/?q={"rut":{"eq":"'.$rut.'"}}';
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


    public function alianzas(){
      $client = new \GuzzleHttp\Client();
      $url = 'https://api.medilink.healthatom.com/api/v1/convenios/';

      $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $this->token
            ]
        ]);
      
      $allAlliance = [];
      $alliance = json_decode($response->getBody());
      $allAlliance[] = $alliance->data;

      while(isset($alliance->links->next)){
          $response = $client->request('GET', $alliance->links->next, [
              'headers'  => [
                  'Authorization' => 'Token ' . $this->token
              ]
          ]);
          $alliance = json_decode($response->getBody());
          $allAlliance[] = $alliance->data;

      }

      return array_merge(...$allAlliance);

    }

    public function alianza($id){
      $client = new \GuzzleHttp\Client();
      $id_empresa = $id;
      $url = 'https://api.medilink.healthatom.com/api/v1/empresas/'.$id_empresa;
      
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

    public function atention($id)
    {
        $client = new \GuzzleHttp\Client();
        $url = 'https://api.medilink.healthatom.com/api/v1/atenciones/'.$id.'/detalles';

        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $this->token
            ]
        ]);

        $atention = json_decode($response->getBody());

        return $atention;
    }

    public function evolution($id)
    {
        $client = new \GuzzleHttp\Client();
        $url = 'https://api.medilink.healthatom.com/api/v1/atenciones/'.$id.'/fichas';

        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $this->token
            ]
        ]);

        $atention = json_decode($response->getBody());

        return $atention;
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

          // if($a->finalizado=1){
          //   $estado = 'Atendido';
          // }else{
          //   $estado = 'No Atendido';
          // }

          // if(empty($action->convenio)){
          //   $action->convenio = 'Sin Convenio';
          // }

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

    public function allActions()
    {
        $client = new \GuzzleHttp\Client();

        $query_string   = '?q={"fecha":{"gt":"2022-09-01"}}';
        $url = 'https://api.medilink.healthatom.com/api/v1/atenciones/';
        $url = $url."".$query_string;

        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $this->token
            ]
        ]);

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
            break;
        }

        return array_merge(...$allActions);
    }

    public function allClients(){

      $client = new \GuzzleHttp\Client();
      $url = 'https://api.medilink.healthatom.com/api/v1/pacientes/';

      $response = $client->request('GET', $url, [
          'headers'  => [
              'Authorization' => 'Token ' . $this->token
          ]
      ]);

      $allclients = [];
      $clients = json_decode($response->getBody());
      $allclients[] = $clients->data;

      while(isset($clients->links->next)){
          $response = $client->request('GET', $clients->links->next, [
              'headers'  => [
                  'Authorization' => 'Token ' . $this->token
              ]
          ]);
          $clients = json_decode($response->getBody());
          $allclients[] = $clients->data;

      }
      return array_merge(...$allclients);
    }



    public function appointmentsProfessional($id, $start, $end){
    
      // Carbon parse date 
      $client = new \GuzzleHttp\Client();
      $id_sucursal    = 1;
      $id_profesional = $id;

      $dateStart =  Carbon::parse($start);
      $dateEnd = Carbon::parse($end);
      $diff = $dateStart->diffInWeeks($dateEnd);

      $start = Carbon::parse($start);
      $end = $dateStart->addWeek();

      $professionalAppointmens = [];
      for($i=0; $i < $diff; $i++){
        $url = 'https://api.medilink.healthatom.com/api/v1/sucursales/'.$id_sucursal.'/profesionales/'.$id_profesional.'/agendas';
        $params =   [
          'fecha_inicio'      => ['eq' => $start->format('Y-m-d')],
          'fecha_fin'         => ['eq' => $end->format('Y-m-d')],
          'mostrar_detalles'  => ['eq' => 0]
        ];

        $response = $client->request('GET', $url, [
          'query'     => "q=".json_encode($params),
                'headers'   => [
                'Authorization' => 'Token ' . $this->token
            ]
        ]);

        //json decode  response
        $appointments = json_decode($response->getBody());
        
        foreach ($appointments->data->fechas as $date => $appointment) {
          $professionalAppointmens[$date] = $appointment;
        }

        $start = $start->addWeek();
        
        if($i == $diff-1){
          $end = $dateEnd;
        } else {
          $end = $end->addWeek();
        }
      }

      return $professionalAppointmens;
    }

    public function addAppointment(Request $request){
      $client = new \GuzzleHttp\Client();
      // ddd($request->all());
      $id_cita = (int)$request->id_appointment;
      $url = 'https://api.medilink.healthatom.com/api/v1/citas/'.$id_cita;

      if($request->id_estado == 7 or $request->id_estado == 13) {
        $id_estado = 3;
      } 

      $response = $client->request('PUT', $url, [
        'headers'  => [
                'Authorization' => 'Token ' . $this->token
            ],
            'json'  => [
              'id_estado'             => $id_estado,
          ]
        ]);

      return redirect('confirmacion/'.$id_cita);
    }

    public function sillones(){
      $client = new \GuzzleHttp\Client();
      $url = 'https://api.medilink.healthatom.com/api/v1/sillones/';

      $response = $client->request('GET', $url, [
          'headers'  => [
              'Authorization' => 'Token ' . $this->token
          ]
      ]);

      echo $response->getBody();
    }

    public function estados(){
      $client = new \GuzzleHttp\Client();

      $url = 'https://api.medilink.healthatom.com/api/v1/citas/estados';

      $response = $client->request('GET', $url, [
          'headers'  => [
              'Authorization' => 'Token ' . $this->token
          ]
      ]);

      echo $response->getBody();
    }

    public function changeAppointment(){
      $client = new \GuzzleHttp\Client();

      $id_cita = 27020;
      $url = 'https://api.medilink.healthatom.com/api/v1/citas/'.$id_cita;

      $response = $client->request('PUT', $url, [
          'headers'  => [
              'Authorization' => 'Token ' . $this->token
          ],
          'json'  => [
              'id_estado'             => 1,
          ]
      ]);

      echo $response->getBody();
    }

    public function nextAppointmentsProfessionals(){
      $professionals = Professional::all();

      return view('professionalsml.index',compact('professionals'));
      return $professionals;
      
    }

    public function nextAppointmentsProfessional($id){
      $professional = Professional::find($id);

      $client = new \GuzzleHttp\Client();
      $url = 'https://api.medilink.healthatom.com/api/v1/profesionales/?q={"rut":{"eq":"'.$professional->user->rut.'"}}';
      
      $response = $client->request('GET', $url, [
          'headers'  => [
              'Authorization' => 'Token ' . $this->token
          ]
      ]);
      
      $professional = json_decode($response->getBody())->data[0];
      $id_profesional = $professional->id;
      $id_sucursal    = 1;
      $url            = 'https://api.medilink.healthatom.com/api/v1/sucursales/'.$id_sucursal.'/profesionales/'.$id_profesional.'/agendas';

      $start = Carbon::now()->format('Y-m-d');
      // end date today in 5 days in format yyyy-mm-dd
      $end = Carbon::now()->addDays(12)->format('Y-m-d');

      $params         =   [
                              'fecha_inicio'      => ['eq' => $start],
                              'fecha_fin'         => ['eq' => $end],
                              'mostrar_detalles'  => ['eq' => 1]
              ];

      $response = $client->request('GET', $url, [
          'query'     => "q=".json_encode($params),
              'headers'   => [
              'Authorization' => 'Token ' . $this->token
          ]
      ]);

      $appointments = json_decode($response->getBody())->data->fechas;
      $appointments = (array)$appointments;
      return view('professionalsml.show',compact('professional','appointments'));
    }

    public function cajas(){
      $client = new \GuzzleHttp\Client();

      $url = 'https://api.medilink.healthatom.com/api/v1/cajas/1';

      $response = $client->request('GET', $url, [
          'headers'  => [
              'Authorization' => 'Token ' . $this->token
          ]
      ]);

      echo $response->getBody();
    }

    public function pagos(){
      $client = new \GuzzleHttp\Client();
      $url = 'https://api.medilink.healthatom.com/api/v1/pagos?q={"fecha_recepcion":{"gt":"2023-04-01"}}';

      $response = $client->request('GET', $url, [
          'headers'  => [
              'Authorization' => 'Token ' . $this->token
          ]
      ]);

      $allPays = [];
      $pays = json_decode($response->getBody());
      $allPays[] = $pays->data;
      $cont = 0;
      while(isset($pays->links->next)){
          $response = $client->request('GET', $pays->links->next, [
              'headers'  => [
                  'Authorization' => 'Token ' . $this->token
              ]
          ]);
          $pays = json_decode($response->getBody());
          $allPays[] = $pays->data;
          if($cont%40 == 0){
            sleep(20);
          }
          $cont++;
      }
      $allPays = array_merge(...$allPays);
      foreach($allPays as $allpay){

        $url = 'https://api.medilink.healthatom.com/api/v1/pagos/'.$allpay->id.'/boletas';
        try {
          $response = $client->request('GET', $url, [
              'headers'  => [
                  'Authorization' => 'Token ' . $this->token
              ]
          ]);
          $pay = json_decode($response->getBody())->data[0];
          Payment::firstOrCreate(
            [
              'id_pago' => $allpay->id
            ],
            [
              'id_pago' => $allpay->id,
              'id_pagador' => $allpay->id_pagador,
              'id_paciente' => $allpay->id_paciente,
              'nombre_paciente' => $allpay->nombre_paciente,
              'rut' => $pay->rut,
              'mediopago' => $allpay->medio_pago,
              'folio' => $pay->folio_documento,
              'tipo_documento' => $pay->tipo_documento,
              'monto_pago' => $allpay->monto_pago,
              'monto_boleta' => $pay->total_boleta,
              'fecha_pago' => $allpay->fecha_recepcion,
            ]
          );
        } catch (ClientException $e) {
          Payment::firstOrCreate(
          [
            'id_pago' => $allpay->id
          ],
          [
            'id_pago' => $allpay->id,
            'id_pagador' => $allpay->id_pagador,
            'id_paciente' => $allpay->id_paciente,
            'nombre_paciente' => $allpay->nombre_paciente,
            'rut' => '0',
            'mediopago' => $allpay->medio_pago,
            'folio' => '0',
            'tipo_documento' => '0',
            'monto_pago' => $allpay->monto_pago,
            'monto_boleta' => '0',
            'fecha_pago' => $allpay->fecha_recepcion,
          ]
        );
        } catch (\Exception $e) {
          Payment::firstOrCreate(
          [
            'id_pago' => $allpay->id
          ],
          [
            'id_pago' => $allpay->id,
            'id_pagador' => $allpay->id_pagador,
            'id_paciente' => $allpay->id_paciente,
            'nombre_paciente' => $allpay->nombre_paciente,
            'rut' => '0',
            'mediopago' => $allpay->medio_pago,
            'folio' => '0',
            'tipo_documento' => '0',
            'monto_pago' => $allpay->monto_pago,
            'monto_boleta' => '0',
            'fecha_pago' => $allpay->fecha_recepcion,
          ]
        );
        }       
      }

    }

    public function pago($id){
      $client = new \GuzzleHttp\Client();
      $url = 'https://api.medilink.healthatom.com/api/v1/pagos/'.$id.'/boletas';

      $response = $client->request('GET', $url, [
          'headers'  => [
              'Authorization' => 'Token ' . $this->token
          ]
      ]);

      $pays = json_decode($response->getBody());
      return $pays;
    }

    public function evoluciones(){
      $client = new \GuzzleHttp\Client();

      $url = 'https://api.medilink.healthatom.com/api/v1/evoluciones/';
      
      $response = $client->request('GET', $url, [
          'headers'  => [
              'Authorization' => 'Token ' . $this->token
          ]
      ]);
      
      echo $response->getBody();
    }

    public function userPays(){
      $user = Auth::user();
      $client = new \GuzzleHttp\Client();
      $url = 'https://api.medilink.healthatom.com/api/v1/pacientes?q={"rut":{"eq":"'.$user->rut.'"}}';
      $url = 'https://api.medilink.healthatom.com/api/v1/pacientes?q={"rut":{"eq":"20427876-8"}}';

      $response = $client->request('GET', $url, [
          'headers'  => [
              'Authorization' => 'Token ' . $this->token
          ]
      ]);

      $user = json_decode($response->getBody())->data[0];

      // return $user;

      // Atenciones
      $url = $user->links[2]->href; 

      // Citas
      $url = $user->links[4]->href; 

      // Pagos
      $url = $user->links[8]->href; 

      $response = $client->request('GET', $url, [
          'headers'  => [
              'Authorization' => 'Token ' . $this->token
          ]
      ]);

      $atenciones = json_decode($response->getBody());

      return $atenciones;

    }

    public function documentosTributarios(){
      $client = new \GuzzleHttp\Client();

      $url = 'https://api.medilink.healthatom.com/api/v1/documentosTributarios/10487/detalles';

      $response = $client->request('GET', $url, [
          'headers'  => [
              'Authorization' => 'Token ' . $this->token
          ]
      ]);

      echo $response->getBody();
      
    }

    public function patient($id){
      $client = new \GuzzleHttp\Client();

      $url = 'https://api.medilink.healthatom.com/api/v1/pacientes/'.$id.'/evoluciones';

      $response = $client->request('GET', $url, [
          'headers'  => [
              'Authorization' => 'Token ' . $this->token
          ]
      ]);

      echo $response->getBody();
    }

    public function calendar(){
      $start = microtime(true);

      $professionals = Professional::google_id();
      foreach($professionals as $professional){
        // echo $professional->google_id."<br>"
        echo $professional->user->email."<br>";
        // $this->listCalendar($professional->google_id);
        // $this->addcalendar($professional->id);
      }

      $time_elapsed_secs = microtime(true) - $start;
      // echo and transform in munites
      echo gmdate("H:i:s", $time_elapsed_secs);
    }

    public function addcalendar($id){
      
      $professional = Professional::find($id);
      $calendarId = $professional->google_id;

      $client = new \GuzzleHttp\Client();
      $url = 'https://api.medilink.healthatom.com/api/v1/profesionales/?q={"rut":{"eq":"'.$professional->user->rut.'"}}';
      
      $response = $client->request('GET', $url, [
          'headers'  => [
              'Authorization' => 'Token ' . $this->token
          ]
      ]);
      
      $professional = json_decode($response->getBody())->data[0];

      $url = $professional->links[1]->href.'?q={"fecha":{"gt":"2023-06-06"}}';
      $response = $client->request('GET', $url, [
          'headers'  => [
              'Authorization' => 'Token ' . $this->token
          ]
      ]);

      $professional_date = json_decode($response->getBody());

      $allprofessional_date = [];
      $professional_date = json_decode($response->getBody());
      $allprofessional_date[] = $professional_date->data;
      while(isset($professional_date->links->next)){
        $response = $client->request('GET', $professional_date->links->next, [
            'headers'  => [
                'Authorization' => 'Token ' . $this->token
            ]
        ]);
        $professional_date = json_decode($response->getBody());
        $allprofessional_date[] = $professional_date->data;
    }

    $allprofessional_date = array_merge(...$allprofessional_date);

    $client = $this->getClient();
    foreach($allprofessional_date as $appointment){
      if(in_array($appointment->estado_cita, ['Cambio de fecha','Anulado vía validación','No asiste','Anulado'])){
          continue;
      }
      $service = new Calendar($client);
      $start = \Carbon\Carbon::parse($appointment->fecha)->format('Y-m-d')."T".$appointment->hora_inicio;
      $end = \Carbon\Carbon::parse($appointment->fecha)->format('Y-m-d')."T".$appointment->hora_fin;
      $event = new Google_Service_Calendar_Event(array(
        'summary' => 'Atención a '.$appointment->nombre_paciente,
        'location' => 'San Pascual 736',
        'description' => "Paciente: ".$appointment->nombre_paciente."\nCon: ".$appointment->nombre_profesional,
        'start' => array(
          'dateTime' => $start,
          'timeZone' => 'America/Santiago',
        ),
        'sendNotifications' => false,
        'sendUpdates' => 'externalOnly',
        'end' => array(
          'dateTime' => $end,
          'timeZone' => 'America/Santiago',
        ),
        'attendees' => array(
          array('email' => 'cristobalugarte6@gmail.com'),
          // array('email' => 'you@justbetter.cl'),
          // array('email' => 'Docencia@justbetter.cl'),
          // array('email' => 'cugarte@guiasyscoutschile.cl'),
          // array('email' => 'iver@justbetter.cl'),
          // array('email' => 'pablo@justbetter.cl'),
        ),
        'reminders' => array(
          'useDefault' => False,
          'overrides' => array(
            array('method' => 'email', 'minutes' => 24 * 60),
            array('method' => 'popup', 'minutes' => 10),
          ),
        ),
      ));

      $event = $service->events->insert($calendarId, $event);

      // print($appointment->estado_cita);
    }

    return $allprofessional_date;
  }

  public function listCalendar($calendarId){
    // $calendarId = $calendar;
    $client = $this->getClient();
    $service = new Calendar($client);
    // $calendarList = $service->calendarList->listCalendarList();
    // $calendarListEntry = $service->calendarList->get($calendarId);

    
    $events = $service->events->listEvents($calendarId);
    while(true) {
      foreach ($events->getItems() as $event) {
        $service->events->delete($calendarId, $event->getID());
      }
      $pageToken = $events->getNextPageToken();
      if ($pageToken) {
        $optParams = array('pageToken' => $pageToken);
        $events = $service->events->listEvents($calendarId, $optParams);
      } else {
        break;
      }
    }
  }

  public function getClient(){
    $client = new GoogleClient();
    $client->setApplicationName('Google Calendar API PHP Quickstart');
    $client->setScopes("https://www.googleapis.com/auth/calendar");
    $client->setAuthConfig(public_path('credentials.json'));
    $client->setAccessType('offline');
    $client->setPrompt('select_account consent');

    // Load previously authorized token from a file, if it exists.
    // The file token.json stores the user's access and refresh tokens, and is
    // created automatically when the authorization flow completes for the first
    // time.
    $tokenPath = public_path('token.json');
    if (file_exists($tokenPath)) {
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);
    }

    // If there is no previous token or it's expired.
    if ($client->isAccessTokenExpired()) {
        // Refresh the token if possible, else fetch a new one.
        if ($client->getRefreshToken()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        } else {
            // Request authorization from the user.
            $authUrl = $client->createAuthUrl();
            printf("Open the following link in your browser:\n%s\n", $authUrl);
            print 'Enter verification code: ';
            $authCode = trim(fgets(STDIN));

            // Exchange authorization code for an access token.
            $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
            $client->setAccessToken($accessToken);

            // Check to see if there was an error.
            if (array_key_exists('error', $accessToken)) {
                throw new Exception(join(', ', $accessToken));
            }
        }
        // Save the token to a file.
        if (!file_exists(dirname($tokenPath))) {
            mkdir(dirname($tokenPath), 0700, true);
        }
        file_put_contents($tokenPath, json_encode($client->getAccessToken()));
    }
    return $client;
  }

}
