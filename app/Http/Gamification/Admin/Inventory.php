<?php

namespace App\Http\Gamification\Admin;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Inventory as InventoryModel;

class Inventory extends Component
{
    use WithPagination;

    public $search = '';
    public $pageCount = 100;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'refreshParent' => '$refresh',
    ];

    public function getData()
    {
        $keySearch = "%{$this->search}%";

        $inventories = InventoryModel::whereNull('deleted_at')
        ->where('name', 'like', $keySearch)
        ->paginate($this->pageCount);

        return [
            'data' => $inventories,
        ];
    }

    public function render()
    {
        return view('gamification.admin.inventory', $this->getData());
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatePageCount($pageCount)
    {
        $this->pageCount = $pageCount;
    }
}