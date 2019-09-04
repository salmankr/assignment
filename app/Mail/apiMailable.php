<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class apiMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $mailRequest;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailRequest)
    {
        $this->mailRequest = $mailRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');
        return $this->from($this->mailRequest->user->email)->html($this->mailRequest->body);
    }
}
