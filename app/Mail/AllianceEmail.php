<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AllianceEmail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $emailData;

    public function __construct($emailData)
    {
        $this->emailData = $emailData;
    }

    public function build()
    {
        return $this->subject('Solicitud de bases de datos alumnos '.$this->emailData['allianceName'])
                    ->cc('alonso@justbetter.cl')
                    ->markdown('emails.alliance-email');
    }
}
