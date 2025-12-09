<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CareerApplicationReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $applicantName;
    public $jobTitle;

    public function __construct($applicantName, $jobTitle)
    {
        $this->applicantName = $applicantName;
        $this->jobTitle = $jobTitle;
    }

    public function build()
    {
        return $this->subject('Confirmation: Application Received')
            ->view('emails.career-confirmation');
    }
}
