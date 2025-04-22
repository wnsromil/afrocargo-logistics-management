<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class ForgetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $userName;
    public $otp;


    /**
     * Create a new message instance.
     *
     * @param string $userName
     * @param string $email
     * @param string $mobileNumber
     * @param string $password
     * @param string $loginUrl
     */
    public function __construct($userName, $otp,)
    {
        $this->userName = $userName;
        $this->otp = $otp;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your OTP Code',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.forget-password-mail',
        );
    }
}
