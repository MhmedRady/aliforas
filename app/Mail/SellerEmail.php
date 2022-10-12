<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SellerEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The User instance.
     *
     * @var string $email
     */
    protected $Data;

    /**
     * Create a new message instance.
     *
     * @param string $email
     * @return void
     */
    public function __construct($data)
    {
        $this->mailData = $data;
    }

    /**
     * Build the message.
     * (drawing Mail ui with markdown style)
     * @return $this
     */
    public function build()
    {
        $url = 'https://www.aliforas.com/verify-email/' . $this->mailData["email"];
        return $this->subject("Mail From " . env("APP_NAME") . " Website")
            ->markdown("emails.sellerEmail", compact("url"))->with(["mailData" => $this->mailData]);
    }
}
