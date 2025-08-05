<?php

namespace App\Observers;

use App\Models\QuestionSession;

class QueSessionObserver
{
    public function creating(QuestionSession $item): void
    {
        $item->session_code = time();
    }
}
