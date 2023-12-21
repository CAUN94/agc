<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;
use Carbon\Carbon;
use Google\Service\CertificateAuthorityService\CaPool;

class Professional extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);

    }

    public static function nextAppointments()
    {
        return AppointmentMl::where('Hora_inicio','>=',\Carbon\Carbon::now('America/Santiago')->format('H:i:s'))
                            ->where('Fecha','>=',\Carbon\Carbon::now('America/Santiago')->format('Y-m-d'))
                            ->where('Estado', '!=', 'Anulado')
                            ->orderby('Hora_inicio','ASC')
                            ->get();
    }

    public static function monthAppointments($first,$last,$user){
        return AppointmentMl::where('Fecha','>',$first)
                        ->where('Fecha','<', $last)
                        ->Where('Profesional', 'LIKE' , '%' . $user . '%')
                        ->Where('Estado','=', 'Atendido')
                        ->count(['Tratamiento_Nr']);
    }

    public static function prestaciones($first,$last,$user){

      return Helper::moneda_chilena(ActionMl::where('Fecha_Realizacion','>',$first)
                      ->where('Fecha_Realizacion','<', $last)
                      ->Where('Profesional', 'LIKE' , '%' . $user . '%')
                      ->Where('Estado','=', 'Atendido')
                      // ->distinct(['Tratamiento_Nr'])
                      ->sum('Precio_Prestacion'));
    }

    public static function abonos($first,$last,$user){

      return Helper::moneda_chilena(ActionMl::where('Fecha_Realizacion','>',$first)
                      ->where('Fecha_Realizacion','<', $last)
                      ->Where('Profesional', 'LIKE' , '%' . $user . '%')
                      ->Where('Estado','=', 'Atendido')
                      // ->distinct(['Tratamiento_Nr'])
                      ->sum('Abono'));
    }

    public static function remuneracion($first,$last,$user){
      $coef = Professional::where('description' ,'=',  $user)->first(['coeff']);
      if(Professional::where('description' ,'=',  $user)->first()->description == 'Nicolás Muñoz Demian '){
        return Helper::moneda_chilena(Professional::monthAppointments($first,$last,$user)*10000);
      }
      return Helper::moneda_chilena(ceil(ActionMl::where('Fecha_Realizacion','>',$first)
                          ->where('Fecha_Realizacion','<', $last)
                          ->Where('Profesional', 'LIKE' , '%' . $user . '%')
                          ->Where('Estado','=', 'Atendido')
                          // ->distinct(['Tratamiento_Nr'])
                          ->sum('Precio_Prestacion')*$coef->coeff));
    }

    public static function Prom_prestaciones($first,$last,$user){
      $coef = Professional::where('description' ,'=',  $user)->first(['coeff']);

     $remuneracion = (ActionMl::where('Fecha_Realizacion','>',$first)
                              ->where('Fecha_Realizacion','<', $last)
                               ->Where('Profesional', 'LIKE' , '%' . $user . '%')
                               ->Where('Estado','=', 'Atendido')
                              //  ->distinct(['Tratamiento_Nr'])
                               ->sum('Precio_Prestacion')*$coef->coeff);

     $appointment = ActionMl::whereBetween('Fecha_Realizacion',[$first, $last])
                             ->Where('Profesional', 'LIKE' , '%' . $user . '%')
                             ->Where('Estado','=', 'Atendido')
                             ->get()->count();

     if($appointment == 0){
       return 0;
     }else{
     return Helper::moneda_chilena(ceil($remuneracion/$appointment));
     }
   }

   public static function Prom_remuneracion($first,$last,$user){
     $coef = Professional::where('description' ,'=',  $user)->first(['coeff']);

      $remuneracion = (ActionMl::whereBetween('Fecha_Realizacion',[$first, $last])
                                ->Where('Profesional', 'LIKE' , '%' . $user . '%')
                                ->Where('Estado','=', 'Atendido')
                                // ->distinct(['Tratamiento_Nr'])
                                ->sum('Precio_Prestacion')*$coef->coeff);

      $appointment = ActionMl::whereBetween('Fecha_Realizacion',[$first, $last])
                              ->Where('Profesional', 'LIKE' , '%' . $user . '%')
                              ->Where('Estado','=', 'Atendido')
                              // ->distinct(['Tratamiento_Nr'])
                              ->get()->count();

      if($appointment == 0){
        return 0;
      }else{
      return ceil($remuneracion/$appointment);
      }
    }

    public static function tasaOcupacion($first,$last,$user){
      $atenciones =  ActionMl::where('Fecha_Realizacion','>',$first)
                               ->where('Fecha_Realizacion','<', $last)
                              ->Where('Profesional', 'LIKE' , '%' . $user . '%')
                              ->Where('Estado','=', 'Atendido')
                              // ->distinct(['Tratamiento_Nr'])
                              ->count(['Tratamiento_Nr']);

      $Ocupacion = Professional::where('description' ,'=',  $user)->first(['Horas_disponible']);

      $Ocupacion = $Ocupacion->Horas_disponible*4;
      $porcentaje = ceil(($atenciones/$Ocupacion)*100);

      return ($porcentaje);
    }

    public static function google_id(){
      return Professional::whereNotNull('google_id')->get();
    }

    public function monthOcupation($month){
      $client = new \GuzzleHttp\Client();
      $url = 'https://api.medilink.healthatom.com/api/v1/profesionales/?q={"rut":{"eq":"'.$this->user->rut.'"}}';


      $response = $client->request('GET', $url, [
          'headers'  => [
              'Authorization' => 'Token ' . config('app.medilink')
          ]
      ]);
      
      $professional = json_decode($response->getBody())->data[0];
      $id_profesional = $professional->id;
      $id_sucursal    = 1;
      $url            = 'https://api.medilink.healthatom.com/api/v1/sucursales/'.$id_sucursal.'/profesionales/'.$id_profesional.'/agendas';
      
      // get month by specific number
      $start1 = Carbon::now()->month($month)->day(1)->format('Y-m-d');
      $end2 = Carbon::now()->month($month)->day(10)->format('Y-m-d');
      
      $countOcupation = $this->ocupationBeetween($id_profesional,$start1,$end2);

      $start2 = Carbon::now()->month($month)->day(11)->format('Y-m-d');
      $end2 = Carbon::now()->month($month)->day(20)->format('Y-m-d');
      
      $countOcupation += $this->ocupationBeetween($id_profesional,$start2,$end2);

      $start3 = Carbon::now()->month($month)->day(21)->format('Y-m-d');
      $end3 = Carbon::now()->month($month)->day(30)->format('Y-m-d');
      
      $countOcupation += $this->ocupationBeetween($id_profesional,$start3,$end3);

      return [$start1,$end3,$countOcupation];
    }

    public function ocupationBeetween($id,$start,$end){
      $client = new \GuzzleHttp\Client();

      $id_sucursal    = 1;
      $url            = 'https://api.medilink.healthatom.com/api/v1/sucursales/'.$id_sucursal.'/profesionales/'.$id.'/agendas';

      $params         =   [
        'fecha_inicio'      => ['eq' => $start],
        'fecha_fin'         => ['eq' => $end],
        'mostrar_detalles'  => ['eq' => 1]
      ];

      $response = $client->request('GET', $url, [
        'query'     => "q=".json_encode($params),
        'headers'   => [
        'Authorization' => 'Token ' . config('app.medilink')
        ]
      ]);

      $appointments = json_decode($response->getBody())->data->fechas;
      $appointments = (array)$appointments;
      

      $availableHours = [];
      foreach($appointments as $key1 => $appointment){
        if(!empty($appointment->horas)){
          $hours = $appointment->horas;
          foreach($hours as $key2 => $hour){
              // sillones has a key name 1
              $hour = (array)$hour;
              $sillones = $hour['sillones'];
              // $sillones = (array)$sillones;
              // stdClass to array $sillones
              $sillones = (array)$sillones;
              $sillones = (array)$sillones[1];
              // check if isset key tipo
              if(isset($sillones['tipo'])){
                if($sillones['tipo'] != 'Bloqueo')
                $availableHours[$key1." ".$key2] = $sillones;
              } else {
                $availableHours[$key1." ".$key2] = $sillones;
              }
      
            }
          }
        }
      
      return count($availableHours); 
    }
}
