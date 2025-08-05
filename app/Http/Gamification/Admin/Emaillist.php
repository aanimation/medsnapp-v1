<?php

namespace App\Http\Gamification\Admin;

use Livewire\Component;

class Emaillist extends Component
{
    protected function getData()
    {
        $items = \App\Models\Waitlist::all();
        return [
            'items' => $items,
        ];
    }

    public function render()
    {
        return view('gamification.admin.emaillist', $this->getData());
    }
}
