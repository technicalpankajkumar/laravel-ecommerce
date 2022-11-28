<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendForgetPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $forgetpass;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($forgetpass)
    {
        $this->forgetpass=$forgetpass;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return dd($this->forgetpass);
        return $this->from("testmaillaravelme@gmail.com","welcome to my projects")
        ->replyTo("technicalpankajkumar@gmail.com","Support for this email")
        ->view('sendforgetemail')
        ->with([
            'token'=>$this->forgetpass['token'],
            'email'=>$this->forgetpass['email']
        ]);
    }
}
