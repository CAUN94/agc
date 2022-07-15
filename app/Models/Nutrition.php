<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nutrition extends Model
{
    use HasFactory;

    public function fecha(){
        return \Carbon\Carbon::parse($this->fecha)->format('Y-m-d');
    }
}
