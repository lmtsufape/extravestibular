<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailAnalista extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($edital)
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
        return $this->from('lmtsteste@gmail.com', 'ExtraSiSU')
            ->subject("Convite para ser analista")
            ->markdown('emailAnalista')->with([
                'edital' => $this->edital,
            ]);
    }
}
