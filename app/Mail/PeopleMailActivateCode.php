<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PeopleMailActivateCode extends Mailable
{
    use Queueable, SerializesModels;

    public $code;
    public $people;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($code, $people)
    {
        $this->code = $code;
        $this->people = $people;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this/*->subject('Mail from ItSolutionStuff.com')*/
        ->view('emails.peopleMailActivateCode');
    }
}
