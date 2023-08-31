<?php

namespace App\Models;

use App\Models\AppointmentMl;
use App\Models\PaymentMl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionMl extends Model
{
    use HasFactory;

    protected $fillable = ['Sucursal','Nombre','Apellido','Categoria_Nr','Categoria_Nombre','Tratamiento_Nr','Profesional','Estado','Convenio','Prestacion_Nr','Prestacion_Nombre','Fecha_Realizacion','Precio_Prestacion','Abono','Total'];

    public function setnameAttribute($value) {
        $this->attributes['name'] = ucfirst(strtolower(trim($value)));
    }

    public function appointments(){
        return $this->hasMany(AppointmentMl::class,'Tratamiento_Nr','Tratamiento_Nr');
    }

    public function payments(){
        return $this->hasMany(PaymentMl::class,'Atencion','Tratamiento_Nr');
    }

    public function treatments(){
        return $this->hasMany(TreatmentMl::class,'Atencion','Tratamiento_Nr');
    }

    public function evolution(){
        $client = new \GuzzleHttp\Client();
        $url = 'https://api.medilink.healthatom.com/api/v1/atenciones/'.$this->Tratamiento_Nr.'/fichas';

        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . config('app.medilink')
            ]
        ]);

        $atention = json_decode($response->getBody());

        return $atention;
    }

    public function checkEvolution(){
        // check if ->data in empty
        if(empty($this->evolution()->data)){
            return false;
        }
        return $this->evolution()->data->campos[0]->timestamp;
    }
}
