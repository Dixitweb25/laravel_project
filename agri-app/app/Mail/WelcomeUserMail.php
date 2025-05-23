<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $password;
    public $appLink;

    /**
     * Create a new message instance.
     */
    public function __construct($email, $password, $appLink)
    {
        $this->email = $email;
        $this->password = $password;
        $this->appLink = $appLink;
    }
    public function build()
    {
        return $this->subject('Welcome to AgriApp')
            ->view('emails.welcome-user');
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
