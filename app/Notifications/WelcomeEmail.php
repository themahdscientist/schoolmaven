<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeEmail extends Notification implements ShouldQueue
{
    use Queueable;

    private $user;
    private $school_name;
    private $smil_code;

    /**
     * Create a new notification instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
        $this->school_name = $user->school->name;
        $this->smil_code = $user->school->smil_code;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('⚡ Welcome to ' . __(config('app.name')))
            ->tag('welcome')
            ->greeting('Hello ' . $this->user->first_name . ',')
            ->line('The ' . __(config('app.name')) . ' team welcomes you to the digital frontier of tomorrow\'s education! ' .  $this->school_name . ' has been provisioned successfully 🎉. Your credentials are outlined below.')
            ->line('School identifier: ' . $this->smil_code)
            ->line('Username: ' . $this->user->username)
            ->line('We will never ask for your login credentials such as your username or password unless in an instance of a compromised account. Do not share your personal information with unverified parties!')
            ->action('View Dashboard', config('app.url') . ':8000/admin/dashboard')
            ->line('Once again, thanks for choosing ' . __(config('app.name')) . ' ✨!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
