<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentMl extends Model
{
    use HasFactory;

    protected $fillable = [
        'Estado',
        'Fecha',
        'Hora_inicio',
        'Hora_termino',
        'Fecha_Generación',
        'Tratamiento_Nr',
        'Profesional',
        'Rut_Paciente',
        'Nombre_paciente',
        'Apellidos_paciente',
        'Mail',
        'Telefono',
        'Celular',
        'Convenio',
        'Convenio_Secundario',
        'Generación_Presupuesto',
        'Sucursal',
    ];

    public function setRut_PacienteAttribute($value) {
        if(Rut::parse($value)->quiet()->validate()){
            $this->attributes['Rut_Paciente'] = Rut::parse(Rut::parse($value)->normalize())->format(Rut::FORMAT_WITH_DASH);
        } else{
            $this->attributes['Rut_Paciente'] = $value;
        }
    }

    public function setCelularAttribute($value) {
        $this->attributes['Celular'] = "+569".substr(preg_replace('/[^0-9]+/', '', $value),-8);
    }

    public function actions(){
        return $this->hasMany(ActionMl::class,'Tratamiento_Nr','Atencion');
    }

    public function payments(){
        return $this->hasMany(PaymentMl::class,'Atencion','Tratamiento_Nr');
    }

    public function treatments(){
        return $this->hasMany(TreatmentMl::class,'Tratamiento_Nr','Atencion');
    }
}
