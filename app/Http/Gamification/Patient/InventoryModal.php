<?php

namespace App\Http\Gamification\Patient;

use Livewire\Component;
use App\Constants\GeneralConstants as Con;

use App\Traits\{
    WithBadges, WithPlayerAtts, WithPlayerInvents, WithSwal
};

use App\Models\{Inventory, UserQuestInv};

class InventoryModal extends Component
{
    use WithBadges, WithPlayerAtts, WithPlayerInvents, WithSwal;

    protected $template = 'inventory-modal';
    protected $player, $targetElement = 'healthCounter';
    protected $healthProp = 'health', $coinProp = 'coins', $expProp = 'exps';

    public $size = 'modal-md', $isAvail = true;
    public $btn = 'purchase-btn'; // btn on modal
    public $price = 0;
    public $icc = 0;

    public $itemId, $type, $icon, $title, $extra, $category, $subCat1, $subCat2, $body, $bodySlot, $compSlot, $components, $valSlot, $values, $damage, $caseId, $questId, $sex, $amount, $hasEnergy = false, $hasCoin = false, $hasAmount = false, $hasUsed = false, $used, $valued, $patientRecover = 0, $expReward = 0, $hasDescription = false, $dependName;

    protected $listeners = ['setInventoryModal'];

    public function setInventoryModal(array $data)
    {
        $this->reset(
            'isAvail',
            'btn',
            'type',
            'title',
            'questId',
            'bodySlot',
            'compSlot',
            'patientRecover',
            'expReward',
            'hasUsed',
            'hasDescription',
            'dependName',
        );

        $questId = $data['questId'];
        $caseId = $data['caseId'];

        $this->sex = $data['sex']; // only investigation use sex filter
        $this->icc = $data['icc'];

        $this->questId = $questId;
        $this->caseId = $caseId;

        $item = Inventory::with([
            'Assoc' => function($query) use($questId) {
                $query->where('amount', '>', 0);
            },
            'Usage' => function($query) use($questId) {
                $query->where('scenario_id', $questId);
            },
            'Value' => function($query) use($questId) {
                $query->where('scenario_id', $questId);
            }
        ])->find($data['itemKey']);

        $this->hasEnergy = $this->HasStock($this->player, $this->healthProp, $item->damage);
        $this->hasCoin = $this->HasStock($this->player, $this->coinProp, $item->price2);

        $this->itemId   = $item->id;
        $this->amount   = $item->user_inv_amount;
        $this->hasAmount= $item->user_inv_exists;
        $this->price    = $item->price2;
        $this->type     = $item->type;
        $this->icon     = $item->icon;
        $this->title    = $item->name;
        $this->extra    = $item->type == Con::TRE ? $item->specifications : null;
        $this->category = $item->category;
        $this->subCat1  = $item->sub1;
        $this->subCat2  = $item->sub2;

        // $this->hasUsed = $item->user_inv_used; // BUG: incorrect attribute
        $this->hasUsed = $item->Usage->where('case_id', $caseId)->count() > 0;
        
        /* examination only */
        $this->damage   = $item->damage;
        $this->bodySlot = null;
        $this->body     = $item->type == Con::EXA
         ? json_decode($item->Value->first()->specifications, true)
         : null;
        if($this->hasUsed && $item->type == Con::EXA) {
            $this->bodySlot = $this->body;
        }

        /* investigation only */
        /**
         * Components and Values must have same count
         */
        $this->compSlot = null;
        $this->components = $item->Components;
        $this->valSlot = null;
        $this->values = $item->Value;
        
        // Special case like `Blood Culture` has description
        // Description will appear when item has in used and there are another investigation item has selected after Blood Culture as next item, least one item.
        if($this->components) {
            if($currentItemInRow = UserQuestInv::whereInvId($item->id)->whereCaseId($caseId)->first()){
                if(UserQuestInv::where('id', '>', $currentItemInRow->id)->whereCaseId($caseId)->whereHas('Inventory', function($query){
                    $query->where('type', 'investigation');
                })->first()){
                    $this->hasDescription = true;
                }
            }
        }
        
        // If value and not empty array, then patient recoverying health
        if($item->type == Con::TRE && $item->Value){
            if($item->Value->count()){ // CORRECT ITEM
                if($item->Value->first()->recovery){
                    $this->patientRecover = $item->Value->first()->recovery/100;
                }else{
                    $this->patientRecover = 9;
                }

                $this->expReward = 2;

                /**
                 * checking alternate value
                 * if alternate ids exists on `users_quests_invs` then no affect
                 */
                if($this->CheckAlternateExists($caseId, $item->Value->where('scenario_id', $questId)->first()->alternates)){
                    $this->patientRecover = 0;
                    $this->expReward = 0;
                }
            }

        }
        

        $this->used = $this->hasUsed ? $this->components : $this->compSlot;
        $this->valued = $this->hasUsed ? $this->values : $this->valSlot;

        // ONLY Examination use energy. other need buy by coin
        if($this->type === Con::EXA){
            $this->btn = 'free-energy-btn';
        }elseif($this->hasAmount){ // user has stock on their inventory
            $this->btn = 'stock-btn';
        }else{
            $this->btn = 'purchase-btn';
        }

        // Special case, only on treatment
        // if invs_quests on selected scenario has depend_by
        if($this->type === Con::TRE && !$this->used){
            if($depend = $this->values->where('depend_by', '<>', null)->first()) {
                if(UserQuestInv::whereInvId($depend->depend_by)->whereUserId($this->player->id)->whereCaseId($caseId)->count() < 1) {
                    $this->dependName = $depend->DependBy->name;
                    $this->btn = 'depend-btn';
                }
            }
        }

        $this->dispatch('inventoryModalEvent', show:true);
    }

    public function boot() 
    {
        $this->player = auth()->user();
    }

    public function apply(int $coinSize = 0, int $expSize = 0, int $healthRecovery = 0) // use button
    {
        $this->isAvail = false; // isAvail is availability of purchase icon or use energy icon, if used already then will false and show the paid-content text

        $damageSize = $this->damage * -1;
        
        if($this->price){
            $coinSize = $this->price * -1;
        }

        if($this->hasUsed || $this->hasAmount){
            $coinSize = 0;
        }

        // Decrease health att by damage size
        // NOTE: Investigation has 0 damage on database as default
        $this->AddPropValue($this->player, $this->healthProp, $damageSize);
        $this->AddPropValue($this->player, $this->coinProp, $coinSize);
        

        // Update the user inventory
        if($this->hasAmount){
            $this->UpdateInvent($this->player->id, $this->itemId);
        }

        // reduce attempts
        $this->ReduceInventAttempt($this->player->id, $this->questId, $this->type);
        
        $this->dispatch('refreshParent');

        // while use energy or coin
        if($this->type === Con::EXA){
            $this->bodySlot = $this->body;
        }

        if($this->type === Con::INV) {
            $this->compSlot = $this->components;
            $this->valSlot = $this->values; // This must be here also
            // find possible new badge
            $this->ApplyBadgePerCategory($this->player->id, Con::INV);
        }

        if($this->type === Con::TRE) { // then treatment
            $this->bodySlot = $this->body;
            $this->valSlot = $this->values;

            // Increase health by call the parent component of Questboard
            $this->dispatch('revivePatientHealth', $healthRecovery);

            if($expSize > 0){
                $this->AddPropValue($this->player, $this->expProp, $expSize);
            }

            // find possible new badge
            $this->ApplyBadgePerCategory($this->player->id, Con::TRE);
        }

        // Log the usage
        $stockUsage = ($this->hasUsed || $coinSize !== 0) ? 0 : 1;
        $this->UpdateQuestInvent($this->player->id, $this->caseId, $this->questId, $this->itemId, $coinSize, $expSize, $damageSize, $stockUsage);

        // Refresh Findings items
        $this->dispatch('refreshUsed');
    }

    public function render()
    {
        return view('gamification.patients.'.$this->template);
    }

}
