<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Freshwork\ChileanBundle\Rut;

class UserMl extends Model
{
    use HasFactory;

    public function setrutAttribute($value) {
        $this->attributes['rut'] = Rut::parse(Rut::parse($value)->normalize())->format(Rut::FORMAT_WITH_DASH);
    }
}
