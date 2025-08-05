<?php

namespace App\Http\Gamification\User;

use Livewire\Component;

use App\Traits\WithPlayerAtts;
use App\Models\User;

class Attributes extends Component
{
    use WithPlayerAtts;

    public User $currentUser;

    public int $increment = 10;
    public int $decrement = -10;

    public function boot()
    {
        $this->currentUser = auth()->user();
    }

    public function render()
    {
        return view('gamification.user.attributes');
    }

    public function changeValue(string $property, int $value)
    {
        $this->AddPropValue($this->currentUser, $property, $value);
    }

}
