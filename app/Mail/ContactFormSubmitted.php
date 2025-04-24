<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class ContactFormSubmitted extends Mailable
{
    public $data;

    // Pass data from the controller to the mail view
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->subject('New Contact Form Submission')
                    ->view('emails.contact'); // Your email view
    }
}
