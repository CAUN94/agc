<?php

namespace App\Models;

use App\Models\TrainAppointment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainBook extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'train_appointment_id'
    ];

    public function TrainAppointment(){
        return $this->belongsTo(TrainAppointment::class);
    }

    public static function bookClass($user_id,$train_appointment_id){
        $bookClass = TrainBook::where('user_id',$user_id)->where('train_appointment_id',$train_appointment_id)->first();
        if ($bookClass != Null){
            return $bookClass;
        }
        return False;
    }
}
