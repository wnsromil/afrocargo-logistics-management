<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegistorMail extends Mailable
{
    use Queueable, SerializesModels;

    public $userName;
    public $email;
    public $mobileNumber;
    public $password;
    public $loginUrl;

    /**
     * Create a new message instance.
     *
     * @param string $userName
     * @param string $email
     * @param string $mobileNumber
     * @param string $password
     * @param string $loginUrl
     */
    public function __construct($userName, $email, $mobileNumber, $password, $loginUrl)
    {
        $this->userName = $userName;
        $this->email = $email;
        $this->mobileNumber = $mobileNumber;
        $this->password = $password;
        $this->loginUrl = $loginUrl;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Registor Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.register-mail',
        );
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