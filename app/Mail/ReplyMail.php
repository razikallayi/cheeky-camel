<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
class ReplyMail extends Mailable
{
    use Queueable, SerializesModels;

   const DESTINATION_EMAIL = "divya@whytecreations.in";

    /**
     * Create a new message instance.
     *
     * @return void
     */

    //public $user;
     public $request;

    public function __construct(Request $request)
    {
        //$this->user = $user;
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.reply-mail');
    }
}
