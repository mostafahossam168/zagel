<?php

namespace App\Observers;

use App\Models\ProviderListing;
use App\Models\User;
use App\Notifications\NewProviderListingNotification;

class ProviderListingObserver
{
    public function created(ProviderListing $listing): void
    {
        $listing->loadMissing('user');

        User::admins()->get()->each(
            fn($admin) => $admin->notify(new NewProviderListingNotification($listing))
        );
    }
}
