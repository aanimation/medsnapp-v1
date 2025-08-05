<?php

namespace App\Http\Gamification\Other;

use Livewire\Component;
use Carbon\Carbon;

use App\Traits\{WithPlayerAtts, WithPlayerInvents, WithSwal};
use App\Models\{DailyReward as DReward, Reward};

class DailyReward extends Component
{
    use WithPlayerAtts, WithPlayerInvents, WithSwal;

    public $dayInMonth = 31;
    public $todayNum;
    public $firstDOTW, $lastDOTW;
    public $weeks = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

    protected $listeners = [
        'optionModalEvent', 
        'claimDailyReward' => 'claimDailyReward'
    ];

    public function boot()
    {
        $now = Carbon::now();
        $this->dayInMonth = $now->dayInMonth();
        $this->todayNum = $now->day;
        $firstDOTW = Carbon::parse($now->firstOfMonth())->dayOfWeek;
        $this->firstDOTW = $firstDOTW == 0 ? 6 : $firstDOTW -1;
        $this->lastDOTW = Carbon::parse($now->lastOfMonth())->dayOfWeek;
    }

    public function claimDailyReward($rewardId = null)
    {
        if(is_null($rewardId) || $rewardId != $this->todayNum)
            return;

        $user = auth()->user();

        if(DReward::whereUserId($user->id)->whereDate('created_at', Carbon::now())->exists()) {
            return;
        }

        $reward = Reward::find($rewardId);

        // Reward Option
        if($inv = $reward->Inventory) {
            if($inv->type === 'treatment' && $inv->has_sibling && $reward->route) {
                return $this->dispatch('optionModalEvent', show:true);
            }
        }

        // Record the reward to daily
        DReward::create(['reward_id' => $rewardId]);

        if($reward->title === 'Coin') {
            $this->AddPropValue($user, 'coins', $reward->amount);
            return $this->CoinsSuccessAlert($reward->amount);
        }

        if($reward->title === 'Energy') {
            $this->AddPropValue($user, 'health', $reward->amount);
            return $this->HealthSuccessAlert($reward->amount);
        }

        $this->UpdateInvent($user->id, $reward->inv_id, $reward->amount);

        $this->dispatch('refreshTops', name:'reward');
        return $this->SuccessfullAlert('You got a '.$reward->title);
    }

    function getData()
    {
        $master = Reward::with('Inventory')
            // ->whereMonthNum(now()->format('m'))
            // ->whereYearNum(now()->format('Y'))
            ->take($this->dayInMonth)
            ->get();

        $data = DReward::whereUserId(auth()->id())->whereMonth('created_at', Carbon::now())->pluck('reward_id')->toArray();

        return [
            'master' => $master,
            'data' => $data,
        ];
    }

    public function render()
    {
        return view('gamification.other.daily-reward', $this->getData());
    }

}