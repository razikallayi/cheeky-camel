<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Newsletter;

class NewslettersMail extends Mailable
{
    use Queueable, SerializesModels;

   //const DESTINATION_EMAIL = "divya@whytecreations.in";

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $results = Newsletter::getNewsletters();
        return $this->view('emails.user-newsletter',compact('results'));
    }
}
