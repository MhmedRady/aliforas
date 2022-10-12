<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProductMailApproveNotApprove extends Mailable
{
    use Queueable, SerializesModels;

    public $product;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($product, $data)
    {
        $this->product = $product;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this/*->subject('Mail from ItSolutionStuff.com')*/
        ->view('emails.productMailApproveNotApprove');
    }
}
