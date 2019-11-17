<?php

namespace extravestibular\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class LembreteCoordenador extends Mailable
{
    use Queueable, SerializesModels;
    public $edital;
    public $diasRestantes;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(String $edital, String $diasRestantes)
    {
        $this->edital = $edital;
        $this->diasRestantes = $diasRestantes;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emailLembreteCoordenador');
    }
}
