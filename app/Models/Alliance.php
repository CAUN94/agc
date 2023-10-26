<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alliance extends Model
{
    use HasFactory;

    protected $fillable = ['name','desc','alliance_name','contact_name','contact_phone_1','contact_phone_2','city','state','email','medilink_desc'];

    // public function setContactPhone1Attribute($value)
    // {
    //     $this->attributes['contact_phone_1'] = preg_replace('/[^0-9]/', '', $value);
    // }

    // public function setContactPhone2Attribute($value)
    // {
    //     $this->attributes['contact_phone_2'] = preg_replace('/[^0-9]/', '', $value);
    // }

    // mutate contact_phone_1 to "569".substr(preg_replace('/[^0-9]/', '', $value), -8);

    public function getContactPhone1Attribute($value)
    {
        return "569".substr($value, -8);
    }

    // Create a value call link whatsapp where you mutate the contact_phone_1 to a whatsapp link with the message "Hola {{contact_name}}! Soy Alonso de You, te escribo para" el numero de whatsapp debe ser +569 y los ultimos 8 digitos de contact_phone_1

    public function getLinkWhatsappAttribute()
    {
        $phone = substr($this->contact_phone_1, -8);
        return 'https://api.whatsapp.com/send?phone=569'.$phone.'&text=Hola%20'.$this->contact_name.'!%20Soy%20Alonso%20de%20You,%20te%20escribo%20para';
    }

}
