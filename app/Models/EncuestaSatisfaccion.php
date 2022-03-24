<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EncuestaSatisfaccion extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function setGustosAttribute($value)
    {
        $this->attributes['gustos'] = json_encode($value);
    }

    public function getGustosAttribute($value)
    {
        return $this->attributes['gustos'] = json_decode($value);
    }
}
