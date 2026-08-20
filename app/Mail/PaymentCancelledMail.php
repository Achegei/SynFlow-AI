<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentCancelledMail extends Mailable
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
            subject: 'Your Payment Was Cancelled',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.payment-cancelled',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}