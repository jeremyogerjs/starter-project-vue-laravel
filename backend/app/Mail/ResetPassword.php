<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $token;
    public $url_spa = "http://localhost:8080/reset-password/"; // url of spa
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$token)
    {
        $this->name     = $name;
        $this->token    = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user['name']   = $this->name;
        $user['url']    = $this->url_spa . $this->token;
        
        return $this->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_NAME'))
            ->subject("password reset Link")
            ->view('ResetPassword',['user' => $user]);
    }
}
