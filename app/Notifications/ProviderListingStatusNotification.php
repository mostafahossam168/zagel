<?php

namespace App\Notifications;

use App\Models\ProviderListing;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class ProviderListingStatusNotification extends Notification implements ShouldBroadcastNow
{
    use Queueable;

    public function __construct(public ProviderListing $listing) {}

    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase(object $notifiable): array
    {
        $approved = $this->listing->status->value === 'approved';

        return [
            'title' => $approved ? 'تم قبول خدمتك!' : 'تم رفض خدمتك',
            'body'  => $approved
                ? '"' . $this->listing->title . '" تمت الموافقة عليها وستظهر على المنصة قريباً'
                : '"' . $this->listing->title . '" لم تُقبل.' . ($this->listing->admin_notes ? ' ' . $this->listing->admin_notes : ''),
            'type'  => 'listing_status',
            'url'   => route('user.profile'),
        ];
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage($this->toDatabase($notifiable));
    }
}
