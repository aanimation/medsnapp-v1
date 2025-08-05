<?php

namespace App\Observers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Exception;

use PlutoLinks\Loops\Laravel\Facades\Loops;

use App\Models\Scenario;

class QuestionObserver
{
    public function creating(Scenario $item): void
    {
        $item->skey = Str::Uuid()->toString();
    }

    public function created(Scenario $item): void
    {
        if(App()->isProduction() && $item->status === 'active') {
            try{
                $transactionId = config('loops.transactional.new-patient');
                $dataVariables = ['lastName' => $item->User->Info->lastname ?? $item->User->Info->firstname ?? 'MedSnapp Member']; 

                // Loops::transactional()->send($transactionId, auth()->user()->email, $dataVariables);
            }catch(Exception $e) {
                Log::warning(['message' => $e->getMessage(), 'loc' => 'new-patient']);
            }
        }
    }

    public function updated(Scenario $item): void
    {
        if(App()->isProduction() && $item->wasChanged('status') && $item->status === 'active') {
            try{
                $transactionId = config('loops.transactional.new-patient');
                $dataVariables = ['lastName' => $item->User->Info->lastname ?? $item->User->Info->firstname ?? 'MedSnapp Member']; 

                // Loops::transactional()->send($transactionId, auth()->user()->email, $dataVariables);
            }catch(Exception $e) {
                Log::warning(['message' => $e->getMessage(), 'loc' => 'new-patient']);
            }
        }
    }
}
