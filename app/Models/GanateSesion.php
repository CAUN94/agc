<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GanateSesion extends Model
{
    protected $guarded = [];

    public function setServicesAttribute($value)
    {
        $this->attributes['services'] = json_encode($value);
    }

    public function getServicesAttribute($value)
    {
        return $this->attributes['services'] = json_decode($value);
    }

    public function setServicesinterestAttribute($value)
    {
        $this->attributes['servicesinterest'] = json_encode($value);
    }

    public function getServicesinterestAttribute($value)
    {
        return $this->attributes['servicesinterest'] = json_decode($value);
    }
}
