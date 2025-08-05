<?php

namespace App\Http\Gamification\Patient;

use Livewire\Component;
use Livewire\WithPagination;

use App\Constants\GeneralConstants as Con;
use App\Traits\WithSwal;

use App\Models\Inventory;

class InventorySteps extends Component
{
    use WithPagination, WithSwal;
    
    protected $template = 'inventory-steps';

    public $left = false;
    public $right = true;
    public $step = 1;

    public $quest;
    public $userQuest;

    public $currCat = 'all';

    public $perPage = 10;
    public $search = '';
    public $isSearch = false;

    protected $listeners = [
        'refreshParent' => '$refresh',
    ];

    public function mount()
    {
        if($this->userQuest->investigation > 0){
            $this->step = 2;
        }

        if($this->userQuest->investigation >= 1 && $this->userQuest->treatment > 0){
            $this->step = 3;
        }

        $this->_updateArrowStep();
    }    

    public function changeCategory(string $cat = null)
    {
        $this->currCat = $cat;
        $this->reset('perPage');
    }

    public function openInventoryModal(string $itemKey, string $type, string $sex = 'male', bool $isUsed = false)
    {
        $attempt = $this->userQuest->{$type};
        if($attempt < $this->quest->{$type.'Max'} || $isUsed) {
            $this->dispatch('setInventoryModal', [
                'itemKey' => $itemKey,
                'questId' => $this->userQuest->scenario_id,
                'caseId' => $this->userQuest->id,
                'sex' => $sex,
                'icc' => 0
            ]);
        }
        else{
            $this->AttemptEmptyAlert(ucfirst($type));
        }
    }

    public function loadMore($type)
    {
        $this->perPage += 10;
    }

    public function toggleSearch($type)
    {
        $this->isSearch = !$this->isSearch;

        $this->reset('search', 'currCat');
    }

    public function giveUp() //retry
    {
        $this->userQuest->updateQuietly([
            'reputation' => -10,
            'is_revived' => false,
            'finished_at' => now()
        ]);

        redirect()->route('lobby');
    }

    protected function getData()
    {
        $type = null;
        $step = $this->step;
        $search = "%{$this->search}%";
        $isSearch = $this->isSearch;
        $cat = $this->currCat;

        if($step == 2){
            $type = Con::INV;
        // }elseif($step == 3){
        //     $type = Con::TRE;
        }else{
            $type = Con::EXA;
        }

        $invs = Inventory::
            with(['Usage'=> function($query){
                $query->where('case_id', $this->userQuest->id);
            }])
            ->withCount(['Usage'=> function($query){
                $query->where('case_id', $this->userQuest->id);
            }])
            ->withCount(['Usage AS history_count' => function($query){
                $query->where('scenario_id', $this->userQuest->scenario_id);
            }])
            ->when(in_array($step, [1,2]), function ($query) use($type) {
                $query->where('type', $type);
            })
            ->when($step == 2 && !$isSearch && $cat != 'all', function ($query) use ($type, $cat) {
                $query->where([
                    'type' => $type,
                    'category' => $cat
                ]);
            })
            ->when($search && $isSearch, function ($query) use ($search) {
                $query->where('name', 'like', $search);
            })
            ->whereNull('deleted_at')
            ->paginate($this->perPage);

        $cats = Inventory::whereType($type)->distinct('category')->pluck('category');

        return [
            'cats' => $cats,
            'invs' => $invs
        ];
    }

    public function render()
    {
        return view('gamification.patients.'.$this->template, $this->getData());
    }

    
    /**
     * Onclick arrows
     */
    public function changeStep(string $direction = 'next')
    {
        $this->reset('search', 'isSearch');

        $step = $direction === 'next' ? $this->step + 1 : $this->step - 1;
        $step = $step > 3 ? 3 : $step;
        $step = $step < 1 ? 1 : $step;

        $this->setStep($step);
    }

    /**
     * Onclick Step number
     */
    public function setStep($step)
    {
        $confirmed = true;

        // onclick 2 or 3
        if($step > 1){
            if($this->userQuest->examination == 0) {
                $confirmed = false;
                $alertMsg = 'Please select at least one examination item';
            }

            // onclick 3
            if($step == 3 && $this->userQuest->investigation == 0){
                $confirmed = false;
                $alertMsg = 'Please select at least one investigation item';
            }
        }

        if($confirmed) {
            $this->step = $step;
            $this->_updateArrowStep();
        }else{
            $this->RequireStepAlert($alertMsg);
        }
    }

    function _updateArrowStep()
    {
        if($this->step == 3){
            $this->right = false;
            $this->left = true;//$this->userQuest->investigation >= 1 && $this->userQuest->investigation < 10;
        }

        if($this->step == 2){
            $this->right = true;//$this->userQuest->investigation >= 1;
            $this->left = true;//$this->userQuest->examination < 5;
        }

        if($this->step == 1){
            $this->right = true;//$this->userQuest->examination >= 1;
            $this->left = false;
        }
    }

}
