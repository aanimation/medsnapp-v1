<?php

namespace App\Http\Gamification\Admin;

use Livewire\Component;

use App\Models\User;

// DEPRECATED
class UserForm extends Component
{

    public function render()
    {
        return view('gamification.admin.user-form');
    }
}