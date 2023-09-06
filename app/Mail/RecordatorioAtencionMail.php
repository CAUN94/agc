<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RecordatorioAtencionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nombreUsuario;
    public $descuento;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nombreUsuario, $descuento)
    {
        $this->nombreUsuario = $nombreUsuario;
        $this->descuento = $descuento;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.recordatorio_atencion')
            ->subject('Mucho sin vernos')
            ->from('desarrollo@justbetter.cl', 'You Just Better');
    }
}
