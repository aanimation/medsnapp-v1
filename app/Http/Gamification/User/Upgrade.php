<?php

namespace App\Http\Gamification\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

use App\Traits\WithPlayerAtts;
use App\Models\{User, Scenario as Question};

class Upgrade extends Component
{
    use WithPlayerAtts;

    public User $currentUser;

    public function boot()
    {
        $this->currentUser = auth()->user();
    }

    public function render()
    {
        return view('gamification.user.upgrade');
    }

}
