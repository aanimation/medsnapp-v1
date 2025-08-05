<?php

namespace App\Http\Gamification\User;

use Livewire\Component;

use App\Models\Inventory as InvModel;

class Inventory extends Component
{

    public $hasInventories = false;
    public $currType = 'investigation';

    public function mount()
    {
        // Init user_inventories
        $this->hasInventories = InvModel::whereHas('Assoc')->take(1)->count() > 1;
    }

    public function setKeyItemInv($key)
    {
        $this->dispatch('setKeyItemInvModal', key:$key);
    }

    public function changeType(string $type)
    {
        $this->currType = $type;
    }

    protected function getData()
    {
        $type = $this->currType;

        $inventories = InvModel::whereHas('Assoc', function($query){
            $query->where('amount', '>', 0);
        })
        ->when($type != 'all', function ($query) use ($type) {
            $query->where('type', $type);
        })
        ->take(12) // All rest user inventories display in modal
        ->get();

        return [
            'inventories' => $inventories,
        ];
    }

    public function render()
    {
        return view('gamification.user.inventory', $this->getData());
    }

}
