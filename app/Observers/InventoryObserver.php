<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Inventory;

class InventoryObserver
{
    public function creating(Inventory $item): void
    {
        $item->skey = Str::Uuid()->toString();
    }
}
