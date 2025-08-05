<?php

namespace App\Observers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\{HeatmapStat, UserQuestInv as TheModel, InvQuestValue as TheValue, Streak};

class UserQuestInvObserver
{
    public function created(TheModel $item): void
    {
        $item->updateQuietly(['is_correct' => TheValue::whereScenarioId($item->scenario_id)->whereInvId($item->inv_id)->exists()]);

        $user = auth()->user();
        $now = Carbon::now();

        if(!$user->today_streak){
            Streak::create([
                'user_id' => $item->user_id,
                'day_date' => $now->toDateString(),
                'is_connected' => $user->yesterday_streak,
            ]);
        }

        // record to heatmap
        HeatmapStat::updateOrCreate([
            'user_id' => $item->user_id,
            'day_week' => $now->dayOfWeek, 
            'week' => $now->weekOfYear,
        ],[
            'activity' => DB::raw('heatmap_stats.activity + 1'),
            'patient' => DB::raw('heatmap_stats.patient + 1')
        ]);
    }
}
