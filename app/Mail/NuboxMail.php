<?php

namespace App\Mail;

use App\Models\SelledPack;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NuboxMail extends Mailable
{
    use Queueable, SerializesModels;

    public $selled_pack;
    public $emit;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($plan,$emit)
    {
        $this->selled_pack = SelledPack::find($plan);
        $this->emit = $emit;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Boleta Pack You')->markdown('emails.packs.boleta');
    }
}
