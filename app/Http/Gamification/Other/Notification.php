<?php

namespace App\Http\Gamification\Other;

use Livewire\Component;
use Illuminate\Support\Facades\Route;

use App\Traits\WithNotification;
use App\Models\{UserNotif, DailyReward};

class Notification extends Component
{
    use WithNotification;

    public $userId;

    public function boot()
    {
        $this->userId = auth()->id();

        //Daily Reward
        $routeName = Route::currentRouteName();
        $showDailyRewardIn = ['player-profile','player-dashboard', 'player-learnboard', 'shop', 'lobby'];
        if(!DailyReward::whereUserId($this->userId)->whereDate('created_at', now())->exists() && in_array($routeName, $showDailyRewardIn)) {
            $this->dispatch('rewardModalEvent', show:true);
        }

    }

    public function markNotifAsRead($userNotifId)
    {
        // Update is_read User Notification quietly
        $this->markAsRead($userNotifId);
    }

    function getData()
    {
        $notifs = UserNotif::whereUserId($this->userId)->whereIsRead(false)->take(10)->get();

        return [
            'notifications' => $notifs,
            'emptyNotifs' => $notifs->count() == 0,
        ];
    }

    public function render()
    {
        return view('gamification.other.notifications', $this->getData());
    }

}
