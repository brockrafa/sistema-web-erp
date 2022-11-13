<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Helpers\Configuracao;
use App\Models\Usuario;

class RecuperacaoSenhaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $url = 'https://www.google.com';
    public $user;
    public $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Usuario $user,$token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->url = Configuracao::SERVE_URL.'/login/password/recovery/'.$this->token;
        return $this->markdown('emails.mensagem-reset-password')->subject('Alteração senha');
    }

   
}
