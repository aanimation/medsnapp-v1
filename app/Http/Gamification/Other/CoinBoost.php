<?php

namespace App\Http\Gamification\Other;

// use PostHog\PostHog;
use Livewire\Component;
use Carbon\Carbon;

use App\Traits\{WithBadges, WithPlayerAtts, WithSwal};
use App\Models\DailyCoin as Bonus;

class CoinBoost extends Component
{
    use WithBadges, WithPlayerAtts, WithSwal;

    public $user;

    public $weekly = [1 => 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 0 => 'sunday'];
    public $dayOfWeek;
    public $isAvail = true;
    public $currentChain = 1;
    public $isChained = false;

    public function mount()
    {
        $this->dayOfWeek = Carbon::now()->dayOfWeek;
        $this->user = auth()->user();
        if( $bonuses = Bonus::whereUserId($this->user->id)->orderBy('id', 'DESC')->first(['day_date', 'chain']) ) {
            $format = 'Y-m-d';
            $last = $bonuses->day_date;
            $this->isChained = $last === Carbon::yesterday()->format($format);
            $chain = $bonuses->chain == 7 || !$this->isChained ? 1 : $bonuses->chain + 1;
            $this->currentChain = $chain;

            $this->isAvail = $last !== Carbon::now()->format($format);
        }
    }

    public function claimDailyCoin()
    {
        $user = $this->user;

        // Redirect to subscription page while free was over and not subscribed yet
        if(!$user->hasSubscribed && $user->free_tier_left_days <= 0) {
            return redirect()->route('subscription');
        }

        $nextChain = $this->currentChain;
        $coinSize = $nextChain * 2;

        Bonus::updateOrCreate([
            'user_id' => $user->id,
            'day_date' => Carbon::now()->format('Y-m-d'),
        ],[
            'coin' => $coinSize,
            'chain' => $nextChain,
        ]);

        if($this->isAvail){
            $this->AddPropValue($user, 'coins', $coinSize);
            $this->AddPropValue($user, 'exps', 1);
            $this->CoinsSuccessAlert($coinSize);
        }

        $this->isAvail = false;

        $this->ApplyBadgePerBonus($user->id, 'coins');

        $this->dispatch('refreshTops', name:'coin');

        /*if(App()->isProduction()) {
            PostHog::capture([
                'distinctId' => auth()->user()->username,
                'event' => '$set',
                'properties' => [
                    '$set' => ['name' => auth()->user()->name, 'email' => auth()->user()->email],
                    '$set_once' => ['initial_url' => url()->current()],
                ]
            ]);
        }*/
    }

    public function render()
    {
        return view('gamification.other.coin-boost');
    }

}
