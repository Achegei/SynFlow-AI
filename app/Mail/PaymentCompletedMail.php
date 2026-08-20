<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentCompletedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
    public User $user,
    public array $emailMetadata = []
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Payment Successful',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.payment-completed',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}