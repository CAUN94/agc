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
        return $this->hasMany(ActionMl::class,'Tratamiento_Nr','Tratamiento_Nr');
    }

    public function payments(){
        return $this->hasMany(PaymentMl::class,'Atencion','Tratamiento_Nr');
    }

    public function treatments(){
        return TreatmentMl::where('Atencion',$this->Tratamiento_Nr)->first();
    }

    public static function balance($date){
        return \DB::table('treatment_mls')
            ->Join('appointment_mls', 'treatment_mls.Atencion', '=' ,'appointment_mls.Tratamiento_Nr')
            ->leftJoin('action_mls', 'action_mls.Tratamiento_Nr', '=' ,'appointment_mls.Tratamiento_Nr')
            ->leftJoin('payment_mls', 'appointment_mls.Tratamiento_Nr', '=' ,'payment_mls.Atencion')
            ->where('appointment_mls.Fecha', '=' ,$date)
            ->select('treatment_mls.*')
            ->get();
    }
}
