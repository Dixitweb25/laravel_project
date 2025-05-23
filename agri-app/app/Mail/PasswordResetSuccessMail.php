<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PasswordResetSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $appLink;
    public $new_pass;

    /**
     * Create a new message instance.
     */
    public function __construct($email, $new_pass, $appLink)
    {
        $this->email = $email;
        $this->new_pass = $new_pass;
        $this->appLink = $appLink;
    }

    public function build()
    {
        return $this->subject('Welcome to AgriApp')
            ->view('emails.password-reset-success');
    }



    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
