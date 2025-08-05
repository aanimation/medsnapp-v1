<?php

namespace App\Http\Gamification\Patient;

use Livewire\Component;

use App\Models\Inventory;

class NoteModal extends Component
{
    protected $template = 'note-modal';

    public $size = 'modal-md';
    public $caseId, $sex, $type;
    public $current;

    protected $listeners = ['setNoteModal'];

    public function setNoteModal(array $data)
    {
        $this->reset();
        $this->caseId = $data['caseId'];
        $this->sex = $data['sex'];
        $this->current = Inventory::withCount('Value')->find($data['key']);
        $this->type = $this->current->type;

        $this->dispatch('noteModalEvent', show:true);
    }

    public function render()
    {
        return view('gamification.patients.'.$this->template);
    }

}
