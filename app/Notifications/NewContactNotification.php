<?php

namespace App\Notifications;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

class NewContactNotification extends Notification implements ShouldBroadcastNow
{
    use Queueable;

    public function __construct(public Contact $contact) {}

    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'رسالة تواصل جديدة',
            'body'  => 'من: ' . $this->contact->name . ' — ' . Str::limit($this->contact->message, 80),
            'type'  => 'contact',
            'url'   => route('dashboard.contacts.index'),
        ];
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage($this->toDatabase($notifiable));
    }
}
