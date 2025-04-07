<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class WarehousemangerMail extends Mailable
{
    use Queueable, SerializesModels;

    public $manager_name;

    public $warehouse_code;
    public $email;
    public $mobileNumber;
    public $password;
    public $loginUrl;

    /**
     * Create a new message instance.
     *
     * @param string $manager_name
     * @param string $email
     * @param string $mobileNumber
     * @param string $password
     * @param string $loginUrl
     */
    public function __construct($manager_name, $email, $mobileNumber, $password, $loginUrl, $warehouse_code)
    {
        $this->manager_name = $manager_name;
        $this->email = $email;
        $this->mobileNumber = $mobileNumber;
        $this->password = $password;
        $this->loginUrl = $loginUrl;
        $this->warehouse_code = $warehouse_code;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('no-reply@afrocargo.com', 'Afro Cargo'),
            subject: 'Register Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.register-email-manager',
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