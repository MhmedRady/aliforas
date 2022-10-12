<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ForgetPassword extends Notification
{
    use Queueable;
    private $tempPassword;

    public function __construct($tempPassword)
    {
        $this->tempPassword = $tempPassword;
    }


    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting('Hello!')
            ->line(__('passwords.restCode', ['var' => "{$this->tempPassword} "]))
            ->line(__('passwords.pUpdatePW'))
            ->line('Thanks For using our App!');
    }

    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }
}
