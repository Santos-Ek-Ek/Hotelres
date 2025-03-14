<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservaConfirmada extends Mailable
{
    use Queueable, SerializesModels;

    public $pdf;

    public function __construct($pdf)
    {
        $this->pdf = $pdf;
    }

    public function build()
    {
        return $this->subject('Reserva Confirmada')
                    ->view('emails.reserva_confirmada')
                    ->attachData($this->pdf->output(), 'reserva.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
