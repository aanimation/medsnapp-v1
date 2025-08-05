<?php

namespace App\Http\Gamification\Patient;

use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

use App\Constants\GeneralConstants as Con;
use App\Traits\{WithSwal, WithPlayerAtts};

use App\Models\{Inventory, UserQuestInv, InvQuestValue, UserQuest};

class InvTreatment extends Component
{
    use WithPagination, WithSwal, WithPlayerAtts;
    
    protected $template = 'inv-treatment';

    public int $normalHealth = 96;
    public $pharm = 'Pharmacological';
    public $nonPharm = 'Non-Pharmacological';
 
    public $step = 3;
    public $userQuest;

    public $currCat = 'Pharmacological';
    public $currCat1 = 'all';
    public $currCat2 = 'all';

    public $perPage = 20;
    public $search = '';
    public $isSearch = false;
    public $isCat = true;

    public $invCorrectCount = 0;
    public $reviveAmount = 0;
    public $maxAttempt = 0;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'reviveConfirmed' => 'reviveConfirmed',
    ];

    public function mount($userQuestId)
    {
        $this->userQuest = UserQuest::find($userQuestId);

        // get correct treatments count of the Scenario
        $this->invCorrectCount = InvQuestValue::whereScenarioId($this->userQuest->scenario_id)->whereHas('Inventory', function($inv){
            $inv->whereType('treatment');
        })->count();

        $this->maxAttempt = $this->userQuest->Quest->{'treatmentMax'};
    }

    public function changeCategory(string $cat = null)
    {
        $this->currCat = $cat;
        $type = Con::TRE;
        $sub1 = Inventory::whereType($type)
                ->whereNull('deleted_at')
                ->whereCategory($cat)
                ->distinct('sub1')
                ->pluck('sub1');

        $this->currCat1 = $sub1->first();

        $this->reset('currCat1', 'currCat2', 'isSearch', 'perPage');
        // $this->changeCatSub2($this->currCat1);
    }

    public function changeCatSub1(string $cat = null)
    {
        $this->currCat1 = $cat;
        $type = Con::TRE;
        $sub2 = Inventory::whereType($type)
                ->where('price', '>', 0)
                ->whereNull('deleted_at')
                ->whereCategory($this->currCat)
                ->whereSub1($cat)
                ->distinct('sub2')
                ->pluck('sub2');

        $this->currCat2 = $sub2->first();
    }

    public function changeCatSub2(string $cat = null)
    {
        $this->currCat2 = $cat;
    }

    public function openInventoryModal(string $itemKey, string $type, string $sex = 'male', bool $multi = false, bool $isUsed = false)
    {
        $now = Carbon::now();

        $attempt = $this->userQuest->{$type};
        $availAttempt = $attempt < $this->maxAttempt;

        if($availAttempt || $isUsed) {
            if($multi){
                $this->dispatch('setRouteModal', [
                    'itemKey' => $itemKey,
                    'questId' => $this->userQuest->scenario_id,
                    'caseId' => $this->userQuest->id,
                    'sex' => $sex, // Not important on treatment item
                    'icc' => $this->invCorrectCount
                ]);
            }else{
                $this->dispatch('setInventoryModal', [
                    'itemKey' => $itemKey,
                    'questId' => $this->userQuest->scenario_id,
                    'caseId' => $this->userQuest->id,
                    'sex' => $sex, // Not important on treatment item
                    'icc' => $this->invCorrectCount
                ]);
            }

            // Update updated_at column for next process
            $this->userQuest->updateQuietly(['updated_at' => $now]);

        }else{ // Condition : Max Attempt was reached
            
            // Waiting for 24 hours (Manegement attempts was empty)
            $restTime = $this->userQuest->updated_at ?? $this->userQuest->created_at;

            $start = Carbon::parse($restTime);
            $end = $start->clone()->addDay(1);

            $restHours = (int)$now->diffInHours($end);
            $restMinutes = (int)$now->diffInMinutes($end);
            
            if($restHours > 0) {
                $rest = 'Wait in '.$restHours.' hours';
            }elseif($restMinutes > 0) {
                $rest = 'Wait in '.$restMinutes.' minutes';
            }else{
                $rest = null;
            }

            if(is_null($rest)){ // User waiting for 24 hours to retry
                $incorrectItems = UserQuestInv::whereCaseId($this->userQuest->id)->whereHas('Inventory', function($query) use($type){
                    $query->where('type', $type);
                })->whereIsCorrect(false)->get();

                $incorrectItemsCount = $incorrectItems->count();
                foreach ($incorrectItems as $deprecated) {
                    $deprecated->delete();
                }

                // update management attempts
                $this->userQuest->updateQuietly([$type => $attempt - $incorrectItemsCount]);

                $this->SuccessfullAlert('Incorrect Managements was resetted successfull');
            }else{
                $this->RestTimeAlert(ucfirst($type), $rest);    
            }
        }
    }

    public function openReviveModal(int $reviveAmount = 0, string $name = '', string $icon = '')
    {
        $this->reviveAmount = $reviveAmount;

        $data = ['name' => $name, 'icon' => $icon];
        $this->dispatch('reviveConfirm', data: $data);
    }

    public function reviveConfirmed()
    {
        // Call the parent component of Questboard
        $this->dispatch('revivePatientHealth', $this->reviveAmount);

        $this->AddPropValue(auth()->user(), 'coins', $this->reviveAmount * -1);

        $this->reset('reviveAmount');

        return $this->NormalSuccessAlert();
    }

    public function loadMore()
    {
        $this->perPage += 10;
    }

    public function toggleSearch()
    {
        $this->isSearch = !$this->isSearch;
        $this->isCat = false; // force to false
        $this->reset('search', 'currCat1', 'currCat2', 'perPage');
    }

    public function toggleCat()
    { 
        $this->isCat = !$this->isCat;
        $this->reset('currCat1', 'currCat2', 'isSearch', 'perPage');
    }

    protected function getData()
    {
        $type = Con::TRE;
        $search = "%{$this->search}%";
        $isSearch = $this->isSearch;
        $cat = $this->currCat;

        $sub1 = Inventory::whereType($type)
                ->whereNull('deleted_at')
                ->whereCategory($cat)
                ->distinct('sub1')
                ->pluck('sub1');

        $catSub1 = $this->currCat1;

        $sub2 = Inventory::whereType($type)
                ->whereNull('deleted_at')
                ->whereCategory($cat)
                ->whereSub1($catSub1)
                ->distinct('sub2')
                ->pluck('sub2');

        $catSub2 = $this->currCat2;

        $invs = Inventory::
            // usage_count will use to check this item was picked at current case
            withCount(['Usage'=> function($query){
                $query->where('case_id', $this->userQuest->id);
            }])
            // history_count will use to check this item was picked at previous same scenario in case
            ->withCount(['Usage AS history_count'=> function($query){
                $query->where('scenario_id', $this->userQuest->scenario_id);
            }])
            ->whereType($type)
            ->when($cat && !$isSearch, function ($query) use ($cat) {
                $query->where('category', $cat);
            })
            ->when($catSub1 !== 'all', function ($query) use ($catSub1) {
                $query->where('sub1', $catSub1);
            })
            ->when($catSub2 !== 'all', function ($query) use ($catSub2) {
                $query->where('sub2', $catSub2);
            })
            ->when($search && $isSearch, function ($query) use ($search) {
                $query->where('name', 'like', $search)->orWhere('sub1', 'like', $search)->orWhere('sub2', 'like', $search);
            })
            ->whereNull('deleted_at')
            ->whereIsSibling(false)
            ->paginate($this->perPage);

        $revives = Inventory::whereType('recovery')->get();

        /**
         * If user already reach all correct treatment
         * But patient health not reach 96 minimum normal health
         * Then show revive options
         */
        $correctCount = UserQuestInv::whereCaseId($this->userQuest->id)->whereHas('Inventory', function($query) use($type){ $query->where('type', $type); })
            ->whereIsCorrect(true)
            ->count();

        return [
            'sub1' => $sub1,
            'sub2' => $sub2,
            'invs' => $invs,
            'revives' => $revives,
            'correctCount' => $correctCount,
        ];
    }

    public function render()
    {
        return view('gamification.patients.'.$this->template, $this->getData());
    }

}
