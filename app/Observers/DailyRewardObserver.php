<?php

namespace App\Observers;

use Carbon\Carbon;
use App\Models\DailyReward;

class DailyRewardObserver
{
    public function creating(DailyReward $item): void
    {
        $userId = auth()->id();
        $isChain = DailyReward::whereUserId($userId)->whereDate('created_at', Carbon::yesterday())->exists();

        $item->user_id = $userId;
        $item->chain = $isChain;
        $item->day_date = Carbon::now()->format('Y-m-d');
    }
}
