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
        ->orWhere('Profesional', 'LIKE' , '%' . $user . '%')
        ->get()->count();
    }

    public static function prestaciones($first,$last,$user){
      return (ActionMl::whereBetween('Fecha_Realizacion',[$first, $last])->orWhere('Profesional', 'LIKE' , '%' . $user . '%')->sum('Precio_Prestacion'))*1;
    }

    public static function abonos($first,$last,$user){
      return (ActionMl::whereBetween('Fecha_Realizacion',[$first, $last])->orWhere('Profesional', 'LIKE' , '%' . $user . '%')->sum('Abono'))*1;
    }

    public static function remuneracion($first,$last,$user){
      return (ActionMl::whereBetween('Fecha_Realizacion',[$first, $last])->orWhere('Profesional', 'LIKE' , '%' . $user . '%')->sum('Total'))*1;
    }
}
