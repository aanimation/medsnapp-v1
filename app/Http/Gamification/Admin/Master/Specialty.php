<?php

namespace App\Http\Gamification\Admin\Master;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Master;

class Specialty extends Component
{
    public function getData()
    {
        $master = Master::where('name', 'speciality')->first(['content']);

        return [
            'data' => $master->content,
        ];
    }

    public function render()
    {
        return view('gamification.admin.master.specialty', $this->getData());
    }
}