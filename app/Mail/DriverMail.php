<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DriverMail extends Mailable
{
    use Queueable, SerializesModels;

    public $driver_name;
    public $email;
    public $mobileNumber;
    public $password;
    public $loginUrl;

    /**
     * Create a new message instance.
     *
     * @param string $driver_name
     * @param string $email
     * @param string $mobileNumber
     * @param string $password
     * @param string $loginUrl
     */
    public function __construct($driver_name, $email, $mobileNumber, $password, $loginUrl)
    {
        $this->driver_name = $driver_name;
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
            subject: 'Register Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.register-email-driver',
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