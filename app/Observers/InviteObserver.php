<?php

namespace App\Observers;

use Illuminate\Support\Facades\{DB, Log};
use Carbon\Carbon;
use Exception;

use PlutoLinks\Loops\Laravel\Facades\Loops;
use App\Models\{HeatmapStat, Invite};

class InviteObserver
{
 
    public function created(Invite $item): void 
    {
        $now = Carbon::now();
        $activateLink = route('invite-player', $item->id);

        try{
            $transactionId = config('loops.transactional.invite');
            $dataVariables = ['link' => $activateLink, 'sender' => $item->User->Info->lastname ?? $item->User->Info->firstname ?? 'MedSnapp Member']; 

            Loops::transactional()->send($transactionId, $item->email, $dataVariables);
        }catch(Exception $e) {
            Log::warning(['message' => $e->getMessage(), 'loc' => 'invite observer']);
        }

        // record to heatmap
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
