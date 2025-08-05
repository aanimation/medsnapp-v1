<?php

namespace App\Http\Gamification\Admin\Master;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Badge as BadgeModel;

class Badge extends Component
{
    use WithPagination;

    public $search = '';
    public $pageCount = 50;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'refreshParent' => '$refresh',
    ];

    public function getData()
    {
        $keySearch = "%{$this->search}%";

        $badges = BadgeModel::whereNotNull('badge_name')
        ->where('badge_name', 'like', $keySearch)
        ->orWhere('category', 'like', $keySearch)
        ->paginate($this->pageCount);

        return [
            'data' => $badges,
        ];
    }

    public function render()
    {
        return view('gamification.admin.master.badge', $this->getData());
    }
}