<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;

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
        return ActionMl::whereBetween('Fecha_Realizacion',[$first, $last])
                        ->Where('Profesional', 'LIKE' , '%' . $user . '%')
                        ->Where('Estado','=', 'Atendido')
                        ->distinct(['Tratamiento_Nr'])
                        ->count(['Tratamiento_Nr']);
    }

    public static function prestaciones($first,$last,$user){

      return Helper::moneda_chilena(ActionMl::whereBetween('Fecha_Realizacion',[$first, $last])
                      ->Where('Profesional', 'LIKE' , '%' . $user . '%')
                      ->Where('Estado','=', 'Atendido')
                      ->distinct(['Tratamiento_Nr'])
                      ->sum('Precio_Prestacion'));
    }

    public static function abonos($first,$last,$user){

      return Helper::moneda_chilena(ActionMl::whereBetween('Fecha_Realizacion',[$first, $last])
                      ->Where('Profesional', 'LIKE' , '%' . $user . '%')
                      ->Where('Estado','=', 'Atendido')
                      ->distinct(['Tratamiento_Nr'])
                      ->sum('Abono'));
    }

    public static function remuneracion($first,$last,$user){
      $coef = Professional::where('description' ,'=',  $user)->first(['coeff']);

      return Helper::moneda_chilena(ceil(ActionMl::whereBetween('Fecha_Realizacion',[$first, $last])
                          ->Where('Profesional', 'LIKE' , '%' . $user . '%')
                          ->Where('Estado','=', 'Atendido')
                          ->distinct(['Tratamiento_Nr'])
                          ->sum('Precio_Prestacion')*$coef->coeff));
    }

    public static function Prom_prestaciones($first,$last,$user){
      $coef = Professional::where('description' ,'=',  $user)->first(['coeff']);

     $remuneracion = (ActionMl::whereBetween('Fecha_Realizacion',[$first, $last])
                               ->Where('Profesional', 'LIKE' , '%' . $user . '%')
                               ->Where('Estado','=', 'Atendido')
                               ->distinct(['Tratamiento_Nr'])
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
                                ->distinct(['Tratamiento_Nr'])
                                ->sum('Precio_Prestacion')*$coef->coeff);

      $appointment = ActionMl::whereBetween('Fecha_Realizacion',[$first, $last])
                              ->Where('Profesional', 'LIKE' , '%' . $user . '%')
                              ->Where('Estado','=', 'Atendido')
                              ->distinct(['Tratamiento_Nr'])
                              ->get()->count();

      if($appointment == 0){
        return 0;
      }else{
      return ceil($remuneracion/$appointment);
      }
    }

    public static function tasaOcupacion($first,$last,$user){
      $atenciones =  ActionMl::whereBetween('Fecha_Realizacion',[$first, $last])
                              ->Where('Profesional', 'LIKE' , '%' . $user . '%')
                              ->Where('Estado','=', 'Atendido')
                              ->distinct(['Tratamiento_Nr'])
                              ->count(['Tratamiento_Nr']);

      $Ocupacion = Professional::where('description' ,'=',  $user)->first(['Horas_disponible']);

      $Ocupacion = $Ocupacion->Horas_disponible*4;
      $porcentaje = ceil(($atenciones/$Ocupacion)*100);

      return ($porcentaje);
    }
}
