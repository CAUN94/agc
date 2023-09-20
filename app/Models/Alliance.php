<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alliance extends Model
{
    use HasFactory;

    protected $fillable = ['name','desc','alliance_name','contact_name','contact_phone_1','contact_phone_2','city','state','email','medilink_desc'];

    public function setContactPhone1Attribute($value)
    {
        $this->attributes['contact_phone_1'] = preg_replace('/[^0-9]/', '', $value);
    }

    public function getContactPhone1Attribute($value)
    {
        return '+569'.$value;
    }

    public function setContactPhone2Attribute($value)
    {
        $this->attributes['contact_phone_2'] = preg_replace('/[^0-9]/', '', $value);
    }

    public function getContactPhone2Attribute($value)
    {
        return '+569'.$value;
    }

}
