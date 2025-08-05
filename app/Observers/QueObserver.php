<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Question;

class QueObserver
{
    public function creating(Question $item): void
    {
        $item->skey = Str::Uuid()->toString();
    }
}
