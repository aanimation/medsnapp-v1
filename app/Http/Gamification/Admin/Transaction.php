<?php

namespace App\Http\Gamification\Admin;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Transaction as TransModel;

class Transaction extends Component
{
    use WithPagination;

    public bool $showAll = false;
    public $search = '';
    public $pageCount = 50;
    protected $paginationTheme = 'bootstrap';

    // public function updatedShowAll($value)
    // {
    //     dd($value);
    // }

    public function getData()
    {
        $keySearch = "%{$this->search}%";
        $inStatus = $this->showAll ? [] : ['unpaid'];

        $transactions = TransModel::whereHas('User', function ($query) use ($keySearch) {
            $query->where('email', 'like', $keySearch);
        })
        ->whereNull('deleted_at')
        ->whereNotIn('status', $inStatus)
        ->orderBy('id', 'DESC')
        ->paginate($this->pageCount);

        return [
            'data' => $transactions,
        ];
    }

    public function render()
    {
        return view('gamification.admin.transaction', $this->getData());
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