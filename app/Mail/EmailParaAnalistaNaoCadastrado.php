<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailParaAnalistaNaoCadastrado extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($edital, $password, $email)
    {
        $this->edital = $edital;
        $this->password = $password;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('lmtsteste@gmail.com', 'ExtraSiSU')
            ->subject("Ative sua conta")
            ->markdown('emailAnalistaNaoCadastrado')->with([
                'edital' => $this->edital,
                'password' => $this->password,
                'email' => $this->email,
            ]);
    }
}
