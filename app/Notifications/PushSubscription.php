<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class PushSubscription extends Notification {
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable) {
        return [WebPushChannel::class];
    }

    public function toWebPush($notifiable, $notification) {
        return (new WebPushMessage())
            ->title("New Message")
            ->icon("https://github.com/fluidicon.png")
            ->body("You got new messages")
            ->action("Close", "close")
            ->options(["TTL" => 1000]);
    }
}
