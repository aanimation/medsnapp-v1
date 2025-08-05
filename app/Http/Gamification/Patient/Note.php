<?php

namespace App\Http\Gamification\Patient;

use Livewire\Component;

use App\Models\{Inventory, UserQuestInv};

/* DEPRECATED */
class Note extends Component
{
    protected $template = 'note';
    
    public $currentSlide = 'examination';
    public $caseId, $sex;
    public $items;

    protected $listeners = [
        'refreshFindings' => 'refreshData',
    ];

    public function mount($caseId, $sex)
    {
        $this->caseId = $caseId;
        $this->sex = $sex;
        $this->getData();
    }

    public function openNoteModal(string $key, string $type)
    {
        $this->dispatch('setNoteModal', [
            'caseId' => $this->caseId,
            'sex' => $this->sex,
            'key' => $key,
        ]);

        $this->currentSlide = $type;
    }

    public function refreshData($type = 'investigation')
    {
        if($type === 'treatment') $type = 'investigation'; // ignore treatment
        $this->currentSlide = $type;
        $this->getData();
    }

    function getData()
    {
        $findings = UserQuestInv::whereCaseId($this->caseId)->pluck('inv_id');

        $this->items = Inventory::whereIn('id', $findings)
            ->orderBy('name', 'ASC')
            ->get(['id', 'skey', 'name', 'type', 'category', 'description', 'specifications', 'icon']);
    }

    public function render()
    {
        return view('gamification.patients.boards.'.$this->template);
    }

}