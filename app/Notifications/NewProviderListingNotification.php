<?php

namespace App\Notifications;

use App\Models\ProviderListing;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

class NewProviderListingNotification extends Notification implements ShouldBroadcastNow
{
    use Queueable;

    public function __construct(public ProviderListing $listing) {}

    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'خدمة جديدة بانتظار المراجعة',
            'body'  => '"' . Str::limit($this->listing->title, 50) . '" — مقدمة من: ' . ($this->listing->user?->name ?? 'مستخدم'),
            'type'  => 'provider_listing',
            'url'   => route('dashboard.provider-listings.show', $this->listing->id),
        ];
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage($this->toDatabase($notifiable));
    }
}
