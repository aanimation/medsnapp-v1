<?php

namespace App\Http\Gamification\User;

use Livewire\Component;

use App\Traits\{WithPlayerAtts, WithPlayerInvents, WithSwal};
use App\Models\Inventory as InvModel;

class InventoryModal extends Component
{
    use WithPlayerAtts, WithPlayerInvents, WithSwal;

    public $investigations, $treatments;
    public $currentItem = null;
    public $currentItemKey;
    public $currType = 'investigation';
    public $message = '';

    protected $listeners = ['setKeyItemInvModal'];

    public function setKeyItemInvModal(string $key)
    {
        $this->selectItem($key);
    }

    public function changeType(string $type)
    {
        $this->reset('currentItem');
        $this->currType = $type;
    }

    protected function getData()
    {
        $type = $this->currType;

        $inventories = InvModel::whereHas('Assoc', function($query){
            $query->where('amount', '>', 0);
        })
        ->when($type, function ($query) use ($type) {
            $query->where('type', $type);
        })
        ->get();

        return [
            'inventories' => $inventories,
        ];
    }

    public function selectItem($key)
    {
        $this->reset('currentItem');
        $this->currentItem = InvModel::find($key);
        $this->currType = $this->currentItem->type;
    }

    public function buyItem(string $key, int $size = 1)
    {
        $item = $this->currentItem;
        $user = auth()->user();

        if($user->Atts->coins >= $item->price){
            $this->AddPropValue($user, 'coins', $item->price * -1);
            $this->UpdateInvent($user->id, $item->id, $size);
        }else{
            $this->EmptyStockAlert('coin');
            // $this->message = 'Issuficient coin!!!';
        }
    }

    public function render()
    {
        return view('gamification.user.inventory-modal', $this->getData());
    }

}
