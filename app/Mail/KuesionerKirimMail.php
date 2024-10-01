<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class KuesionerKirimMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pembagian;

    public function __construct($pembagian)
    {
        $this->pembagian = $pembagian;
    }

    public function build()
    {
        return $this->subject('Pengiriman Kuesioner')
                    ->view('emails.kuesioner'); // Buat view untuk email
    }
}
