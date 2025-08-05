<?php

namespace App\Http\Gamification\Patient;

use Livewire\Component;

use App\Constants\GeneralConstants as Con;
use App\Models\Inventory;

class RouteModal extends Component
{
    protected $template = 'route-modal';

    public $size = 'modal-md', $type;
    public $itemKey, $caseId, $questId, $sex, $icc;

    protected $listeners = ['setRouteModal'];

    public function setRouteModal(array $data)
    {
        $this->reset();
        $this->type = Con::TRE;
        $this->itemKey = $data['itemKey'];
        $this->caseId = $data['caseId'];
        $this->questId = $data['questId'];
        $this->sex = $data['sex'];
        $this->icc = $data['icc'];

        $this->dispatch('routeModalEvent', show:true);
    }

    public function continue($selectedKey)
    {
        $this->dispatch('routeModalEvent', show:false);

        $this->dispatch('setInventoryModal', [
            'itemKey' => $selectedKey,
            'questId' => $this->questId,
            'caseId' => $this->caseId,
            'sex' => $this->sex, // Not important on treatment item
            'icc' => $this->icc,
        ]);
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
