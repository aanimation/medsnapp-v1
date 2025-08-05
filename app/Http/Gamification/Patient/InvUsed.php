<?php

namespace App\Http\Gamification\Patient;

use Livewire\Component;

use App\Constants\GeneralConstants as Con;

class InvUsed extends Component
{
    public $userQuest;

    protected $listeners = [
        'refreshUsed' => 'getData',
    ];

    public function openNoteModal(string $key)
    {
        $this->dispatch('setNoteModal', [
            'caseId' => $this->userQuest->id,
            'sex' => $this->userQuest->Quest->sex,
            'key' => $key,
        ]);
    }

    public function getData()
    {
        $used = $this->userQuest->UsageInv;

        $exa = $used->filter(function($item){
            return $item->Inventory->type === Con::EXA;
        });

        $inv = $used->filter(function($item){
            return $item->Inventory->type === Con::INV;
        });

        $tre = $used->filter(function($item){
            return $item->Inventory->type === Con::TRE;
        });

        return [
            'exa' => $exa,
            'inv' => $inv,
            'tre' => $tre
        ];
    }

    public function render()
    {
        return view('gamification.patients.boards.used-items', $this->getData());
    }

}
