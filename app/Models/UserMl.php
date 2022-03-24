<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Freshwork\ChileanBundle\Rut;

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
            $this->attributes['RUT'] = Rut::parse(Rut::parse($value)->normalize())->format(Rut::FORMAT_WITH_DASH);
        } else{
            $this->attributes['RUT'] = $value;
        }

    }

    public function setCelularAttribute($value) {
        $this->attributes['Celular'] = "+569".substr(preg_replace('/[^0-9]+/', '', $value),-8);
    }
}
