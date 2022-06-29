<?php

namespace App\Models;

use App\Helpers\Helper;
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

    public function totalPay(){
        return $this->TotalAtencion - $this->TotalAbonado;
    }

    public function totalPrice(){
        return Helper::moneda_chilena($this->totalPay());
    }

    public function isPay(){
        if($this->totalPay() <= 0 or $this->medilink){
            return True;
        }
        return False;
    }
}
