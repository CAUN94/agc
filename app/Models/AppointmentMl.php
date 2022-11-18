<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        'professional_calendar',
        'user_calendar'
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

    public static function nextProfessional($professional){
        return AppointmentMl::where('Fecha','>=',\Carbon\Carbon::now()->startOfDay()->format('Y-m-d'))
            ->where('Profesional',$professional)
            ->where('professional_calendar','like',0)
            ->whereNotIn('Estado',['Cambio de fecha','Anulado'])
            ->orderby('Fecha','asc')->limit(50);
    }

    public static function calendarAppointments($professional){
        return AppointmentMl::where('Fecha','>=',\Carbon\Carbon::yesterday()->startOfDay()->format('Y-m-d'))
            ->where('Profesional',$professional)
            ->where('professional_calendar','not like',0);
    }

    public static function allCalendarAppointments($professional){
        return DB::table('appointment_mls as a')
            ->whereRaw("a.Fecha >='".\Carbon\Carbon::yesterday()->startOfDay()->format('Y-m-d')."'")
            ->whereExists(function ($query) use ($professional) {
               $query->select(DB::raw(1))
                     ->from('appointment_mls as b')
                     ->where('a.Profesional',$professional)
                     ->whereRaw('a.Hora_inicio = b.Hora_inicio')
                     ->whereRaw('a.Fecha = b.Fecha')
                     ->whereRaw('a.Rut_Paciente = b.Rut_Paciente')
                     ->whereRaw('a.Profesional = b.Profesional')
                     ->whereRaw("a.Estado like 'Agenda Online'")
                     ->whereRaw("a.professional_calendar not like '0'")
                     ->havingRaw('count(*) > 1');
           });
    }

    public static function lastAppointment($id){
        $appointmentMl = AppointmentMl::find($id);
        $rut = $appointmentMl->RUT_Paciente;
        $appointment_mls = AppointmentMl::where('RUT_Paciente',$rut)->where('Fecha','<=',\Carbon\Carbon::now()->endOfDay())->orderby('Fecha','desc')->whereIn('Estado',['Atendido','Atendiendose'])->take(1)->first();
        if (!is_null($appointment_mls)){
            return $appointment_mls;
        }
        return $appointmentMl;
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
