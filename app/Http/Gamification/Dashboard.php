<?php

namespace App\Http\Gamification;

use PostHog\PostHog;
use Livewire\Component;

use App\Traits\WithBadges;
use App\Models\User;

class Dashboard extends Component
{
    use WithBadges;

    public User $currentUser;

    public function mount()
    {
        $user = User::find(auth()->id());
        $this->currentUser = $user;

        if($user->is_new){
            $this->ApplyBadge($user->id, 'Level 1');
            $user->updateQuietly(['is_new' => false]);
        }

        if(App()->isProduction()) {
            PostHog::capture([
                'distinctId' => auth()->user()->username,
                'event' => '$set',
                'properties' => [
                    '$set' => ['name' => auth()->user()->name, 'email' => auth()->user()->email],
                    '$set_once' => ['initial_url' => url()->current()],
                ]
            ]);
        }
    }

    public function render()
    {
        return view('gamification.user.dashboard');
    }
}
