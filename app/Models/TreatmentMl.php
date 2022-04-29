<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreatmentMl extends Model
{
    use HasFactory;

    protected $fillable = ['Ficha','Nombre','Apellidos','Atencion','Profesional','TotalAtencion','TotalLaboratorios','TotalRealizado','TotalAbonado','Avance','Global','Proxima_cita'];
}
