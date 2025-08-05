<?php

namespace App\Http\Gamification\Other;

use Carbon\Carbon;
use PostHog\PostHog;
use Livewire\Component;
use App\Models\{DailyCoin, DailyEnergy, DailyReward};

class Bonuses extends Component
{

    public $coin = false;
    public $energy = false;
    public $reward = false;

    protected $listeners = [
        'refreshTops' => 'refreshComp',
    ];

    public function refreshComp($name)
    {
        $this->{$name} = false;
    }

    public function mount()
    {
        $userId = auth()->id();
        $now = Carbon::now();

        $this->coin = DailyCoin::whereUserId($userId)->whereDate('created_at', $now)->orderBy('created_at', 'DESC')->count() == 0;
        $this->energy = DailyEnergy::whereUserId($userId)->whereDate('created_at', $now)->orderBy('created_at', 'DESC')->count() == 0;
        $this->reward = DailyReward::whereUserId($userId)->whereDate('created_at', $now)->orderBy('created_at', 'DESC')->count() == 0;
    }

    public function render()
    {
        return view('gamification.other.bonuses');
    }

}
