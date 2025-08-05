<?php

namespace App\Http\Gamification\Patient;

use PostHog\PostHog;

use Livewire\Component;

use App\Traits\WithSwal;
use App\Models\{
    Scenario,
    UserQuest,
    UserQuestInv
};

class QuestLobby extends Component
{
    use WithSwal;

    protected string $template = 'quest-lobby';
    public $allCases, $selectedCaseKey;

    public $player;
    public $totalPatient;
    public $sumReputation;
    public $successCount;
    public $failedCount;
    public $unfinished;
    public $userQuestCount = 0;
    public $summary;

    /**
     * Initialize component with user data.
     *
     * @return void
     */
    public function mount()
    {
        $user = auth()->user();
        if($user->username === 'demo-user'){
            $this->allCases = Scenario::whereStatus('active')->orderBy('order')->get();
            $this->selectedCaseKey = $this->allCases->first()->skey;
        }

        $this->initializeUserQuestData($user);

        if (app()->isProduction()) {
            $this->trackUser();
        }
    }

    /**
     * Initialize user quest data.
     *
     * @param mixed $user
     * @return void
     */
    protected function initializeUserQuestData($user): void
    {
        $userQuest = UserQuest::whereUserId($user->id);

        // Checking User Quest Count
        $this->userQuestCount = $userQuest->clone()->count();
        
        // Checking unfinished quest to Resume
        $this->unfinished = $userQuest->clone()->whereNull('finished_at')->orderBy('id', 'DESC')->first();
        
        // Summary of User Quests
        $this->summary = UserQuest::whereUserId($user->id)->orderBy('id', 'DESC')->get();
        
        // Total patients and reputation metrics
        $this->totalPatient = UserQuest::whereUserId($user->id)->count();
        $this->sumReputation = UserQuest::whereUserId($user->id)->sum('reputation');
        $this->successCount = UserQuest::whereUserId($user->id)->whereNotNull('finished_at')->whereNotNull('reputation')->where('reputation', '>', 0)->count();
        $this->failedCount = UserQuest::whereUserId($user->id)->whereNotNull('finished_at')->whereNotNull('reputation')->where('reputation', '<', 0)->count();
    }

    /**
     * Track user activity using PostHog.
     *
     * @return void
     */
    protected function trackUser(): void
    {
        PostHog::capture([
            'distinctId' => auth()->user()->username,
            'event' => '$set',
            'properties' => [
                '$set' => [
                    'name' => auth()->user()->name,
                    'email' => auth()->user()->email,
                ],
                '$set_once' => [
                    'initial_url' => url()->current(),
                ],
            ]
        ]);
    }

    public function render()
    {
        if(auth()->user()->username === 'demo-user'){
            return view('gamification.patients.demo-quest-lobby');
        }else{
            return view('gamification.patients.'.$this->template);
        }
    }

    /**
     * Redirect to the quest room.
     *
     * @param int $key
     * @return void
     */
    function getRoom($key)
    {
        redirect()->route('questboard', $key);
    }

    /**
     * Resume an unfinished quest.
     *
     * @param int $key
     * @return void
     */
    public function resume($key)
    {
        $this->getRoom($key);
    }

    /**
     * Retry a previous quest.
     *
     * @param int $id
     * @return void
     */
    public function retry($id)
    {
        $user = auth()->user();

        // Force user to resume the last unfinished patient case
        if($user->HasActiveQuest) {
            $this->resume($this->unfinished->id);
        }

        $lastTry = UserQuest::find($id);

        //Replicate case
        $newCase = UserQuest::create([
            'user_id' => $user->id,
            'scenario_id' => $lastTry->scenario_id,
            'amount' => $lastTry->quest->attributes['curr_health'],
        ]);

        $lastTry->delete();
        $newCase->fresh();

        $this->getRoom($newCase->id);
    }

    /**
     * Pre-start checks before starting a new quest.
     *
     * @return void
     */
    public function preStart()
    {
        $user = auth()->user();

        // if($user->hasExpired) {
        //     return $this->dispatch('openUpgradeOffers');
        // }

        if($user->hasSubscribed || $user->username == 'demo-user') {
            return $this->start();
        }

        if($this->userQuestCount < 2) {
            return $this->start();
        }

        return $this->dispatch('openUpgradeOffers');
    }

    /**
     * Start a new patient quest.
     *
     * @return void
     */
    public function start()
    {
        if (session()->has('next-route-num')) {
            session()->forget('next-route-num');
        }

        $patient = $new = null;
        $userId = auth()->id();

        $patients = UserQuest::whereUserId($userId)->whereNotNull('finished_at')->whereNotNull('reputation')->pluck('scenario_id');
        
        if(count($patients)){
            $patient = Scenario::whereStatus('active')->whereNotIn('id', $patients)->orderBy('order', 'ASC')->first();
        }else{
            $new = Scenario::whereStatus('active')->orderBy('order', 'ASC')->first();
        }

        if($new){
            $patient = $new;
        }

        if($patient){
            $fresh = UserQuest::create([
                'user_id' => $userId,
                'scenario_id' => $patient->id,
                'amount' => $patient->attributes['curr_health'],
            ]);

            $fresh->fresh();

            return $this->getRoom($fresh->id);
        }else{         
            // Waiting new patient
            return $this->NoPatientAlert();
        }
    }


    /**
     * DEMO USER ONLY
     */

    /**
     * Start a demo quest.
     *
     * @return void
     */
    public function startDemo()
    {
        $quest = Scenario::find($this->selectedCaseKey);

        $patient = UserQuest::updateOrCreate([
            'user_id' => auth()->id(),
            'scenario_id' => $quest->id,
        ],[
            'amount' => $quest->attributes['curr_health'],
            'updated_at' => now(),
        ]);

        $patient->fresh();

        $this->getRoom($patient->id);
    }

    /**
     * Reset demo quest data.
     *
     * @param int $key
     * @return void
     */
    public function resetDemo($key)
    {
        $userId = auth()->id();
        $quest = Scenario::find($key);

        // delete all inv has used before
        UserQuestInv::whereUserId($userId)->whereScenarioId($quest->id)->forceDelete();

        // reset data
        UserQuest::whereUserId($userId)->whereScenarioId($quest->id)->update([
            'examination' => 0,
            'investigation' => 0,
            'treatment' => 0,
            'amount' => $quest->attributes['curr_health'],
            'reputation' => null,
            'is_revived' => 0,
            'finished_at' => null,
            'revived_at' => null,
            'updated_at' => null,
        ]);

        $this->summary = UserQuest::whereUserId($userId)->get();
    }

}
