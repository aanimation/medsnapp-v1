<?php

namespace App\Observers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\{HeatmapStat, Transaction as Trans};

class TransactionObserver
{
    public function creating(Trans $item): void
    {
        $item->skey = Str::Uuid()->toString();
        $item->trans_code = time();
        $item->trans_datetime = now();
    }

    public function created(Trans $item): void
    {
        $now = Carbon::now();

        if($item->trans_type === 'currency'){
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
}
