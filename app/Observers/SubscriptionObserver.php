<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Subscription;

class SubscriptionObserver
{
    public function creating(Subscription $item): void
    {
        $item->tier_code = Str::random(3).time();
    }
}
