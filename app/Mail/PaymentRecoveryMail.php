<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentRecoveryMail extends Mailable
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
            subject: 'Complete Your Payment and Continue Your Enrollment',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.payment-recovery',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}