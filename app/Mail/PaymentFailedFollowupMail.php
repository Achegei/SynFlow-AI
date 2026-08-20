<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentFailedFollowupMail extends Mailable
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
            subject: 'Let’s Help You Complete Your Payment',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.payment-failed-followup',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}