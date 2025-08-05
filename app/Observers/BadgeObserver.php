<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Badge;

class BadgeObserver
{
    public function creating(Badge $item): void
    {
        $item->skey = Str::Uuid()->toString();
    }
}
