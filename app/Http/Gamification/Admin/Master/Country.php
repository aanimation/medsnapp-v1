<?php

namespace App\Http\Gamification\Admin\Master;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Country as CountryModel;

class Country extends Component
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

        $items = CountryModel::whereNotNull('name')
        ->where('name', 'like', $keySearch)
        ->paginate($this->pageCount);

        return [
            'data' => $items,
        ];
    }

    public function render()
    {
        return view('gamification.admin.master.country', $this->getData());
    }
}