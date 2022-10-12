<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class resetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The User instance.
     *
     * @var \App\Models\User
     */
    protected $user;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\User
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     * (drawing Mail ui with markdown style)
     * @return $this
     */
    public function build()
    {
//        $message = "Dear {$this->user->name}, <br/> We Got your cover to reset your password." ;
        $message = "Dear {$this->user->name}, <br/> We Got your cover to reset your password.";
        $url = route("web.resetPassword") . $this->user->email;
        return $this->subject('Reset Your Password')
            ->markdown('emails.resetPassword')->with([
                'message' => $message,
                'url' => $url
            ]);
    }
}
