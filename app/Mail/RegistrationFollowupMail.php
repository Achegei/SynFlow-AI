<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegistrationFollowupMail extends Mailable
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
            subject: 'Ready to Continue Your Moose Loon AI Journey?',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.registration-followup',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}