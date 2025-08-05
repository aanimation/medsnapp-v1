<?php

namespace App\Observers;

use App\Models\{UserAtts, UserAttsLog};

class UserAttsObserver
{

    public function updated(UserAtts $item): void
    {
        if($item->wasChanged('exps')){
            UserAttsLog::create([
                'user_id' => $item->user_id,
                'exps' => $item->exps
            ]);
        }

        if($item->wasChanged('coins')){
            UserAttsLog::create([
                'user_id' => $item->user_id,
                'coins' => $item->coins
            ]);
        }

        if($item->wasChanged('health')){
            UserAttsLog::create([
                'user_id' => $item->user_id,
                'health' => $item->health
            ]);
        }

    }
}
