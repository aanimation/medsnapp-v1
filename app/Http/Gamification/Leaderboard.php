<?php

namespace App\Http\Gamification;

use Livewire\Component;

use App\Models\User;

class Leaderboard extends Component
{

    public $status = 'down';

    public function setStatus($status)
    {
        $this->status = $status === 'down' ? 'up' : 'down';
    }

    public function getData()
    {
        $items = User::with(['Atts'])
            ->whereHas('Role', function ($query) {
                $query->where('role_name', 'Player');
            })
            ->where('name', 'NOT LIKE', '%demo-user%')
            ->whereNotNull('email_verified_at')
            ->whereIsActive(true)
            ->whereIsLocked(false)
            ->orderBy('level', 'desc')
            ->orderBy('rank', 'desc')
            ->get(['id', 'name', 'username', 'is_active', 'level', 'rank'])
            ->sortByDesc('Atts.exps')->take(12);

        $top3 = array_values($items->take(3)->toArray());

        return [
            'items' => $items,
            'top3' => $top3,
        ];
        
    }

    public function render()
    {
        return view('gamification.leaderboard', $this->getData());
    }

}
