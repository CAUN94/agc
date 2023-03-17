<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelledPack extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'user_name',
        'professional_id',
        'professional_name',
        'pack_id',
        'pack_name',
    ];
}
