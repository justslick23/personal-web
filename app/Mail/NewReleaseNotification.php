<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewReleaseNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $type;
    public $title;
    public $url;

    public function __construct($type, $title, $url)
    {
        $this->type = $type;
        $this->title = $title;
        $this->url = $url;
    }

    public function build()
    {
        // Capitalize the type (song/album) and set a better subject
        $subject = 'New ' . ucfirst($this->type) . ' Released: ' . $this->title;

        return $this->subject($subject)
                    ->view('emails.new_release')  // Ensure this view exists
                    ->with([
                        'type' => ucfirst($this->type),
                        'title' => $this->title,
                        'url' => $this->url,
                    ]);
    }
}
