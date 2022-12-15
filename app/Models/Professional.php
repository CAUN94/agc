<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function nextAppointments(){
        return AppointmentMl::where('Hora_inicio','>=',\Carbon\Carbon::now('America/Santiago')->format('H:i:s'))
                            ->where('Fecha','>=',\Carbon\Carbon::now('America/Santiago')->format('Y-m-d'))
                            ->where('Estado', '!=', 'Anulado')
                            ->orderby('Hora_inicio','ASC')
                            ->get();
    }

    public static function monthAppointments($first,$last,$user){
       //where('Profesional' , '=', 'Alonso Niklitschek Sanhueza')
        return ActionMl::whereBetween('Fecha_Realizacion',[$first, $last])
        ->Where('Profesional', 'LIKE' , '%' . $user . '%')
        ->Where('Estado','=', 'Atendido')
        ->distinct(['Tratamiento_Nr'])
        ->count(['Tratamiento_Nr']);
    }

    public static function prestaciones($first,$last,$user){
      return (ActionMl::whereBetween('Fecha_Realizacion',[$first, $last])
      ->Where('Profesional', 'LIKE' , '%' . $user . '%')
      ->Where('Estado','=', 'Atendido')
      ->sum('Precio_Prestacion'));
    }

    public static function abonos($first,$last,$user){
      return (ActionMl::whereBetween('Fecha_Realizacion',[$first, $last])
      ->Where('Profesional', 'LIKE' , '%' . $user . '%')
      ->Where('Estado','=', 'Atendido')
      ->sum('Abono'));
    }

    public static function remuneracion($first,$last,$user){
      if($user == "Daniella Vivallo Vera" || $user == "Jaime Pantoja Rodriguez"){
        $coef=0.45;
      }elseif($user == "Constanza Ahumada Huerta"){
        $coef=0.32;
      }else{
        $coef=1;
      }
      return ceil(ActionMl::whereBetween('Fecha_Realizacion',[$first, $last])
      ->Where('Profesional', 'LIKE' , '%' . $user . '%')
      ->Where('Estado','=', 'Atendido')
      ->sum('Precio_Prestacion')*$coef);
    }

    public static function Prom_prestaciones($first,$last,$user){
      if($user == "Daniella Vivallo Vera" || $user == "Jaime Pantoja Rodriguez"){
        $coef=0.45;
      }elseif($user == "Constanza Ahumada Huerta"){
        $coef=0.32;
      }else{
        $coef=1;
      }
     $remuneracion = (ActionMl::whereBetween('Fecha_Realizacion',[$first, $last])
     ->Where('Profesional', 'LIKE' , '%' . $user . '%')
     ->Where('Estado','=', 'Atendido')
     ->sum('Precio_Prestacion')*$coef);

     $appointment = ActionMl::whereBetween('Fecha_Realizacion',[$first, $last])
     ->Where('Profesional', 'LIKE' , '%' . $user . '%')
     ->Where('Estado','=', 'Atendido')
     ->get()->count();
     if($appointment == 0){
       return 0;
     }else{
     return ceil($remuneracion/$appointment);
     }
   }

   public static function Prom_remuneracion($first,$last,$user){
     if($user == "Daniella Vivallo Vera" || $user == "Jaime Pantoja Rodriguez"){
       $coef=0.45;
     }elseif($user == "Constanza Ahumada Huerta"){
       $coef=0.32;
     }else{
       $coef=1;
     }
      $remuneracion = (ActionMl::whereBetween('Fecha_Realizacion',[$first, $last])
      ->Where('Profesional', 'LIKE' , '%' . $user . '%')
      ->Where('Estado','=', 'Atendido')
      ->sum('Precio_Prestacion')*$coef);

      $appointment = ActionMl::whereBetween('Fecha_Realizacion',[$first, $last])
      ->Where('Profesional', 'LIKE' , '%' . $user . '%')
      ->Where('Estado','=', 'Atendido')
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

      if($user == "Daniella Vivallo Vera"){
        $Ocupacion=25;
      }elseif($user == "Constanza Ahumada Huerta"){
        $Ocupacion=22;
      }else{
        $Ocupacion=30;
      }

      $Ocupacion = $Ocupacion*4;
      $porcentaje = ceil(($atenciones/$Ocupacion)*100);

      return ($porcentaje);
    }
}
