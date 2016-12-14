<?php

namespace Jumper\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class QuickMessage extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($msg = "")
    {
        $this->msg = $msg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $content = $this->msg;
        return $this->from(config('app.mail_from'),config('app.name'))
                    ->subject(isset($content->subject)?$content->subject:"")
                    ->view('ThankyouMessage::quickMessage', compact('content'));
    }
}
