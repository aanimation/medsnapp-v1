<?php

namespace App\Observers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\{HeatmapStat, UserInv, Streak};

class UserInvObserver
{
    public function created(UserInv $item): void
    {
        // $user = auth()->user();
        $now = Carbon::now();

        // if(!$user->today_streak){
        //     Streak::create([
        //         'user_id' => $item->user_id,
        //         'day_date' => $now->toDateString(),
        //         'is_connected' => $user->yesterday_streak,
        //     ]);
        // }

        // record to heatmap
        HeatmapStat::updateOrCreate([
            'user_id' => $item->user_id,
            'day_week' => $now->dayOfWeek, 
            'week' => $now->weekOfYear,
        ],[
            'activity' => DB::raw('heatmap_stats.activity + 1'),
            'shop' => DB::raw('heatmap_stats.shop + 1'),
        ]);
    }

    public function updated(UserInv $item): void
    {
        $now = Carbon::now();

        if($item->wasChanged('amount')){
            HeatmapStat::updateOrCreate([
                'user_id' => $item->user_id,
                'day_week' => $now->dayOfWeek, 
                'week' => $now->weekOfYear,
            ],[
                'activity' => DB::raw('heatmap_stats.activity + 1'),
                'shop' => DB::raw('heatmap_stats.shop + 1'),
            ]);
        }

    }
}
