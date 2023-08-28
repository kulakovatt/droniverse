<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendPDFMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pdf,$pdf2,$id_order)
    {
        $this->pdf = $pdf;
        $this->pdf2 = $pdf2;
        $this->number = $id_order;
    }

    public function build()
    {
        return $this->from('paperatravel@gmail.com', 'Droniverse Team')
            ->subject('Заказ №'.$this->number)
            ->view('messageOrder')
            ->attachData($this->pdf->output(), 'гарантия.pdf')
            ->attachData($this->pdf2->output(), 'чек.pdf');
    }
}
