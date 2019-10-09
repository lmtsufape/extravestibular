<?php

namespace extravestibular\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResultadosForamDivulgados extends Mailable
{
    use Queueable, SerializesModels;
    public $edital;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct(String $edital)
     {
         $this->edital = $edital;
     }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emailResultadosForamDivulgados');
    }
}
