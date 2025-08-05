<?php

namespace App\Http\Gamification\User;

use Livewire\Component;

use App\Models\User;

class Levels extends Component
{
    public User $currentUser;

    public function boot()
    {
        $this->currentUser = auth()->user();
    }

    public function render()
    {
        return view('gamification.user.levels');
    }

}
