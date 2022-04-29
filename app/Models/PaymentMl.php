<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMl extends Model
{
    use HasFactory;

    protected $fillable = ['Atencion','Profesional','Especialidad','Pago_Nr','Fecha','Rut','Nombre','Apellidos','Tipo_Paciente','Convenio','Convenio_Secundario','Boleta_Nr','Total','Asociado','Medio','Banco','RutBanco','Cheque','Vencimiento','Generado'];
}
