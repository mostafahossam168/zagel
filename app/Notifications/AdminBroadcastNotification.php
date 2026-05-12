<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class AdminBroadcastNotification extends Notification implements ShouldBroadcastNow
{
    use Queueable;

    public function __construct(
        public string $title,
        public string $body,
    ) {}

    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => $this->title,
            'body'  => $this->body,
            'type'  => 'broadcast',
            'url'   => null,
        ];
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'title'      => $this->title,
            'body'       => $this->body,
            'type'       => 'broadcast',
            'created_at' => now()->toISOString(),
        ]);
    }


}
