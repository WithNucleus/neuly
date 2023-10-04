<?php

namespace App\Mail;

use App\Models\Email;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailMarketingMail extends Mailable
{
    use Queueable, SerializesModels;

    public Email $email;

    public function __construct(Email $email)
    {
        $this->email = $email;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->email->from_email, $this->email->from_name),
            subject: $this->email->subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.email-marketing.default'
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
