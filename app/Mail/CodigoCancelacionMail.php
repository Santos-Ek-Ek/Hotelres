<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CodigoCancelacionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $codigoCancelacion;

    public function __construct($codigoCancelacion)
    {
        $this->codigoCancelacion = $codigoCancelacion;
    }

    public function build()
    {
        return $this->subject('Código de Cancelación')
                    ->view('emails.codigo_cancelacion')
                    ->with([
                        'codigoCancelacion' => $this->codigoCancelacion,
                    ]);
    }
}