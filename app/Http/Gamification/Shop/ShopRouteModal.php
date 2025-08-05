<?php

namespace App\Http\Gamification\Shop;

use Livewire\Component;

use App\Constants\GeneralConstants as Con;

use App\Models\Inventory;

class ShopRouteModal extends Component
{
    protected $template = 'route-modal';

    public $size = 'modal-md', $type;
    public $itemKey;

    protected $listeners = ['setRouteModal'];

    public function setRouteModal($key)
    {
        $this->reset();
        $this->type = Con::TRE;
        $this->itemKey = $key;

        $this->dispatch('routeModalEvent', show:true);
    }

    public function continue($key)
    {
        $this->dispatch('routeModalEvent', show:false);

        $this->dispatch('setShopModal', key:$key);
    }

    protected function getData()
    {
        $item = null;
        $siblings = [];

        if($this->itemKey){
            $item = Inventory::find($this->itemKey);
            $siblings = Inventory::whereName($item->name)->get(['skey','specifications']);
        }

        return [
            'title' => $item->name ?? '',
            'siblings' => $siblings,
        ];
    }

    public function render()
    {
        return view('gamification.patients.'.$this->template, $this->getData());
    }

}
