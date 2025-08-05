<?php

namespace App\Http\Gamification\Admin;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Scenario;

class Patient extends Component
{
    use WithPagination;

    public $search = '';
    public $pageCount = 10;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'refreshParent' => '$refresh',
    ];


    public function reorder(string $key, string $direction = 'up')
    {
        $current = Scenario::find($key);

        if($direction === 'up'){
            $exchange = Scenario::where('order', '<', $current->order)->orderBy('order', 'DESC')->first();
            $exchange->increment('order');
            $current->decrement('order');
        }else{
            $exchange = Scenario::where('order', '>', $current->order)->orderBy('order', 'ASC')->first();
            $exchange->decrement('order');
            $current->increment('order');
        }
    }

    public function destroy($key)
    {
        Scenario::find($key)->delete();
    }

    public function getData()
    {
        $keySearch = "%{$this->search}%";

        $quests = Scenario::where('type', 'like', $keySearch)
            ->orWhere('name', 'like', $keySearch)
            ->orWhere('description', 'like', $keySearch)
            // ->orWhere('sex', $keySearch)
            ->orderBy('order')
            ->paginate($this->pageCount);

        return [
            'data' => $quests,
        ];
    }

    public function render()
    {
        return view('gamification.admin.patient', $this->getData());
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