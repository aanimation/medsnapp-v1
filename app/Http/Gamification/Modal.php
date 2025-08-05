<?php

namespace App\Http\Gamification;

use Livewire\Component;

// DEPRECATED
class InventoryModal extends Component
{
    protected $template = 'inventory-modal';

    public $btn = 'warning';
    public $label = 'Start';

    public $size = 'modal-lg';
    public $title = 'Modal Title';


    public function mount($title)
    {
        $this->title = $title;
    }

    protected function getData()
    {
        return [
            'title' => $this->title,
        ];
    }

    public function render()
    {
        return view('gamification.'.$this->template, $this->getData());
    }

}
