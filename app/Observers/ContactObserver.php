<?php

namespace App\Observers;

use App\Models\Contact;
use App\Models\User;
use App\Notifications\NewContactNotification;

class ContactObserver
{
    public function created(Contact $contact): void
    {
        User::admins()->get()->each(
            fn($admin) => $admin->notify(new NewContactNotification($contact))
        );
    }
}
