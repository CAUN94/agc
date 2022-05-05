<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreatmentMl extends Model
{
    use HasFactory;

    protected $fillable = ['Ficha','Nombre','Apellidos','Atencion','Profesional','TotalAtencion','TotalLaboratorios','TotalRealizado','TotalAbonado','Avance','Global','Proxima_cita'];

    public function actions(){
        return $this->hasMany(ActionMl::class,'Tratamiento_Nr','Atencion');
    }

    public function payments(){
        return $this->hasMany(PaymentMl::class,'Atencion','Atencion');
    }

    public function appointments(){
        return $this->hasMany(AppointmentMl::class,'Tratamiento_Nr','Atencion');
    }
}
