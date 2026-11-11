<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifyRegistrationMail extends Mailable
{
    use Queueable, SerializesModels;


    public function __construct(private string $url) {}

  
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Verify Registration Mail from BazaarFlow',
        );
    }


    public function content(): Content
    {
        return new Content(
            view: 'emails.registrationRequestEmail',
            with: [
                'url' => $this->url
            ]
        );
    }

   
    public function attachments(): array
    {
        return [];
    }
}
