<?php

namespace App\Observers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\{HeatmapStat, Streak, QuestionStat, QuestionUser};

class QueUserObserver
{
    public function created(QuestionUser $item): void
    {
        $user = auth()->user();
        $now = Carbon::now();

        if(!$user->today_streak && $item->question_id){
            Streak::create([
                'user_id' => $item->user_id,
                'day_date' => $now->toDateString(),
                'is_connected' => $user->yesterday_streak,
            ]);
        }

        // record to stat
        QuestionStat::updateOrCreate([
            'question_id' => $item->question_id,
        ],[
            'correct' => DB::raw('question_stats.correct + '.($item->is_correct ? 1 : 0)),
            'incorrect' => DB::raw('question_stats.incorrect + '.(!$item->is_correct ? 1 : 0)),
            'a' => DB::raw('question_stats.a + '.($item->answer == 0 ? 1 : 0)),
            'b' => DB::raw('question_stats.b + '.($item->answer == 1 ? 1 : 0)),
            'c' => DB::raw('question_stats.c + '.($item->answer == 2 ? 1 : 0)),
            'd' => DB::raw('question_stats.d + '.($item->answer == 3 ? 1 : 0)),
            'e' => DB::raw('question_stats.e + '.($item->answer == 4 ? 1 : 0))
        ]);

        // record to heatmap
        HeatmapStat::updateOrCreate([
            'user_id' => $item->user_id,
            'day_week' => $now->dayOfWeek, 
            'week' => $now->weekOfYear,
        ],[
            'activity' => DB::raw('heatmap_stats.activity + 1'),
            'question' => DB::raw('heatmap_stats.question + 1')
        ]);
    }
}
