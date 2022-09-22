<?php

namespace App\Models;

use App\Models\AppointmentMl;
use Freshwork\ChileanBundle\Rut;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserMl extends Model
{
    use HasFactory;

    protected $fillable = [
        'Nombre',
        'Apellidos',
        'Fecha_Ingreso',
        'Ultima_Cita',
        'RUT',
        'Nacimiento',
        'Celular',
        'Ciudad',
        'Comuna',
        'Direccion',
        'Email',
        'Observaciones',
        'Sexo',
        'Convenio'
    ];

    public function setrutAttribute($value) {
        if(Rut::parse($value)->quiet()->validate()){
            $this->attributes['RUT'] = strtolower(Rut::parse(Rut::parse($value)->normalize())->format(Rut::FORMAT_WITH_DASH));
        } else{
            $this->attributes['RUT'] = $value;
        }

    }

    public function setCelularAttribute($value) {
        $this->attributes['Celular'] = "+569".substr(preg_replace('/[^0-9]+/', '', $value),-8);
    }

    public function lastAppointment(){
        return AppointmentMl::where('RUT_Paciente','16874329-7')->where('Fecha','<=',Carbon::now())->orderby('Fecha','desc')->whereIn('Estado',['Atendido'])->skip(1)->take(1)->first();
    }


}
