<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $email;
    public $url;

    public function __construct($token, $email, $url)
    {
        $this->token = $token;
        $this->email = $email;
        $this->url = $url;
    }

    public function build()
    {
        return $this->subject('Reset Password')
            ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->to($this->email)
            ->view('mail.reset-mail')
            ->with([
                'token' => $this->token,
                'email' => $this->email,
                'url' => $this->url
            ]);
    }
}
