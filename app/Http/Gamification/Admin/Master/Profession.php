<?php

namespace App\Http\Gamification\Admin\Master;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Master;

class Profession extends Component
{
    public function getData()
    {
        $master = Master::where('name', 'profession')->first(['content']);

        return [
            'data' => $master->content,
        ];
    }

    public function render()
    {
        return view('gamification.admin.master.profession', $this->getData());
    }
}