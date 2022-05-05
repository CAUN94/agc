<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMl extends Model
{
    use HasFactory;

    protected $fillable = ['Atencion','Profesional','Especialidad','Pago_Nr','Fecha','Rut','Nombre','Apellidos','Tipo_Paciente','Convenio','Convenio_Secundario','Boleta_Nr','Total','Asociado','Medio','Banco','RutBanco','Cheque','Vencimiento','Generado'];

    public function actions(){
        return $this->hasMany(ActionMl::class,'Tratamiento_Nr','Atencion');
    }

    public function appointments(){
        return $this->hasMany(AppointmentMl::class,'Tratamiento_Nr','Atencion');
    }

    public function treatments(){
        return $this->hasMany(TreatmentMl::class,'Atencion','Atencion');
    }
}
