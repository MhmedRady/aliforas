<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The User instance.
     *
     * @var string $email
     */
    protected $email;

    /**
     * Create a new message instance.
     *
     * @param string $email
     * @return void
     */
    public function __construct(string $email)
    {
        $this->email = $email;
    }

    /**
     * Build the message.
     * (drawing Mail ui with markdown style)
     * @return $this
     */
    public function build()
    {
        $welcome = 'We are happy to see you ';
        $message = 'Happy marketing with us ';
        $url = url('verify-email/' . $this->email);
        return $this->subject('verify your email')
            ->markdown('emails.verifyEmail')->with([
                'welcome' => $welcome,
                'message' => $message,
                'url' => $url
            ]);
    }
}
