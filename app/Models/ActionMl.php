<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionMl extends Model
{
    use HasFactory;

    protected $fillable = ['Sucursal','Nombre','Apellido','Categoria_Nr','Categoria_Nombre','Tratamiento_Nr','Profesional','Estado','Convenio','Prestacion_Nr','Prestacion_Nombre','Fecha_Realizacion','Precio_Prestacion','Abono','Total'];

    public function setnameAttribute($value) {
        $this->attributes['name'] = ucfirst(strtolower(trim($value)));
    }
}
