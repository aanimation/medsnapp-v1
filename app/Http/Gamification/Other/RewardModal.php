<?php

namespace App\Http\Gamification\Other;

use Livewire\Component;
use Carbon\Carbon;

use App\Traits\{WithPlayerAtts, WithPlayerInvents, WithSwal};
use App\Models\{DailyReward as DReward, Reward};

class RewardModal extends Component
{
    use WithPlayerAtts, WithPlayerInvents, WithSwal;

    public $todayNum;

    // prepare for option on DailyReward component
    public $option = [
        'invId' => null,
        'name' => '',
        'price' => 0,
        'route' => '',
        'rewardId' => null,
        'siblings' => [],
    ];

    public function mount()
    {
        // check if today reward is treatment type
        $this->todayNum = Carbon::now()->day;
        if($item = Reward::whereDayNum($this->todayNum)->whereType('treatment')->whereNotNull('route')->first()) {

            $inv = $item->Inventory;

            $this->option['invId'] = $inv->id; //default invId
            $this->option['name'] = $inv->name;
            $this->option['price'] = $inv->price;
            $this->option['route'] = $item->route;
            $this->option['rewardId'] = $item->id;
            $this->option['siblings'] = $inv->siblings;
        }
    }

    public function claimTreatmentReward($invId, int $price = 0)
    {
        DReward::create([
            'reward_id' => $this->todayNum,
            'inv_id' => $invId,
        ]);

        $this->UpdateInvent(auth()->id(), $invId, 1);
        $this->AddPropValue(auth()->user(), 'coins', $price * -1);

        $this->dispatch('optionModalEvent', show:false);
        $this->dispatch('rewardModalEvent', show:false);
        $this->dispatch('refreshTops', name:'reward');

        // return $this->SuccessfullAlert('Your reward successfully claimed');
    }

    public function render()
    {
        return view('gamification.other.reward-modal');
    }

}
