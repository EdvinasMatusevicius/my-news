<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetAdminPasswordNotification extends Notification
{
    use Queueable;

    private $token;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $token)
    {
        $this->token=$token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail(CanResetPassword $notifiable)
    {
        $url = route('admin.password.reset',[
            'token'=>$this->token,
            'email'=>$notifiable->getEmailForPasswordReset()
        ]);
        $minutes = config('auth.passwords.admins.expire');
        return (new MailMessage)
                    ->subject('Reset admin password')
                    ->line('You are receiving this email because we received a password reset request for your account.')
                    ->action('Reset password', $url)
                    ->line('This password reset link will expire in '.$minutes.' minutes.')
                    ->line('If you did not request a password reset, no further action is required.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
