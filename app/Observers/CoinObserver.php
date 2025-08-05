<?php

namespace App\Observers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\{DailyCoin, HeatmapStat};

class CoinObserver
{
    public function created(DailyCoin $item): void
    {
        $now = Carbon::now();

        HeatmapStat::updateOrCreate([
            'user_id' => $item->user_id,
            'day_week' => $now->dayOfWeek, 
            'week' => $now->weekOfYear,
        ],[
            'activity' => DB::raw('heatmap_stats.activity + 1'),
            'other' => DB::raw('heatmap_stats.other + 1') 
        ]);
    }
}
