<?php

namespace App\Http\Gamification\Patient;

use Livewire\Component;

use App\Traits\{WithPlayerAtts, WithPlayerInvents, WithSwal};
use App\Models\{Inventory, UserQuest};

class ReviveModal extends Component
{
    use WithPlayerAtts, WithPlayerInvents, WithSwal;

    protected $template = 'revive-modal';

    public $size = 'modal-md';
    public $player, $caseId, $questId;

    protected $listeners = ['setReviveModal'];

    public function setReviveModal(array $data)
    {
        $this->reset();
        $this->caseId = $data['caseId'];
        $this->questId = $data['questId'];

        $this->dispatch('reviveModalEvent', show:true);
    }

    public function boot() 
    {
        $this->player = auth()->user();
    }

    public function revive($selectedKey)
    {
        $this->dispatch('reviveModalEvent', show:false);

        $selected = Inventory::find($selectedKey);
        $amount = $selected->damage;
        $coinSize = $selected->price * -1;
        $hasAmount = $selected->user_inv_exists;

        if($this->player->atts->coins > $selected->price || $hasAmount){
            //Recovery patient health
            $case = UserQuest::find($this->caseId);
            $case->updateQuietly(['amount' => $amount, 'is_revived' => true]);

            if($hasAmount){
                $this->UpdateInvent($this->player->id, $selected->id);
            }else{
                $this->AddPropValue($this->player, 'coins', $coinSize);
            }
            
            // Log the usage
            $this->UpdateQuestInvent($this->player->id, $this->caseId, $this->questId, $selected->id, $coinSize, 0, 0, ($hasAmount ? 1 : 0));

            $this->SuccessfullAlert('Patient health revived successfull');
        }else{
            $this->EmptyStockAlert('coins');
        }
    }

    protected function getData()
    {
        return [
            'revives' => Inventory::whereType('recovery')->get(),
        ];
    }

    public function render()
    {
        return view('gamification.patients.'.$this->template, $this->getData());
    }

}
