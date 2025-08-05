<?php

namespace App\Http\Gamification\Patient;

use Exception;
use Livewire\Component;

use App\Traits\{WithPlayerAtts, WithPlayerInvents, WithSwal};
use App\Models\UserQuest;

class Questboard extends Component
{
    use WithPlayerAtts, WithPlayerInvents, WithSwal;

    protected $template = 'questboard';
    protected int $normalHealth = 96;
    protected int $reputation = 10;
    protected bool $recoveryMode = false;

    public $player;
    public $quest;
    public UserQuest $userQuest;
    public $attemptIsUp = false;

    protected $listeners = [
        'reducePatientHealth' => 'reducePatientHealth',
        'revivePatientHealth' => 'revivePatientHealth',
        'giveUp' => 'giveUp', // retry
        'revive' => 'revive',
        'recovery' => 'recovery',
    ];

    public function mount($key = null)
    {
        try {
            $userQuest = UserQuest::findOrFail($key);
        } catch(Exception $e) {
            return redirect()->route('lobby');
        }

        $this->player = auth()->user();
        
        $this->userQuest = $userQuest;
        $this->quest = $userQuest->Quest;

        if($userQuest->reputation || $userQuest->finished_at){
            $this->dispatch('finishConfirm');
        }

        // Set recovery mode based on user quest status
        $this->setRecoveryMode();

        // Reduce health based on time elapsed
        if(app()->isProduction() && $userQuest->amount > 1 && (!$this->player->hasSubscribed || $this->player->hasExpired)){
            if($updated = $userQuest->updated_at){
                $diffHours = $updated->diffInHours(now());
                $this->reducePatientHealth($diffHours);
            }
        }

        // Handle unsuccessful attempts
        $this->handleUnsuccessfulAttempt();

        if($this->userQuest->amount >= $this->normalHealth){
            $this->succeed($userQuest);
        }

        $this->attemptIsUp = $userQuest->treatment === $this->quest->treatmentMax;
    }

    /**
     * Set recovery mode based on user quest conditions.
     *
     * @return void
     */
    protected function setRecoveryMode(): void
    {
        $this->recoveryMode = $this->userQuest->amount < 1 || $this->userQuest->is_revived;
    }

    /**
     * Handle the case when the patient was not helped.
     *
     * @return void
     */
    protected function handleUnsuccessfulAttempt()
    {
        if ($this->userQuest->amount <= 1 && $this->recoveryMode) {
            $this->ChangeLevelValue($this->userQuest, 'reputation', $this->reputation * -1);
            $this->PatientNotHelpedAlert();
        }
    }

    /**
     * Reduce the patient's health.
     *
     * @param int $healthSize
     * @return void
     */
    public function reducePatientHealth(int $healthSize = 1)
    {
        $userQuest = $this->userQuest;
        $healthSize = ($userQuest->amount - $healthSize) < 0 ? $userQuest->amount : $healthSize;

        if($userQuest->amount <= 0 && is_null($userQuest->reputation)){
            $this->ChangeLevelValue($userQuest, 'reputation', $this->reputation*-1);
            $this->PatientNotHelpedAlert();
        }else{
            $userQuest->decrement('amount', $healthSize);
        }
    }

    /**
     * Revive the patient and adjust health.
     *
     * @param int $healthSize
     * @return void
     */
    public function revivePatientHealth(int $healthSize = 1)
    {
        $userQuest = $this->userQuest;
        $healthSize = ($userQuest->amount + $healthSize) > 100 ? (100 - $userQuest->amount) : $healthSize;
        $userQuest->increment('amount', $healthSize);

        if($userQuest->amount < 1 && !$userQuest->is_revived){
            $this->recoveryMode = true;
        }

        $this->attemptIsUp = $userQuest->treatment === $this->quest->treatmentMax;

        if($userQuest->amount >= $this->normalHealth){
            $this->dispatch('inventoryModalEvent', show:false);
            $this->succeed($userQuest);
        }
    }


    /**
     * Handle successful quest completion.
     *
     * @param UserQuest $userQuest
     * @return void
     * 
     * SUCCESS
     * Set Reward
     * 10 Reputation
     * 20 Exps
     * 20 Coins
     * 20 Energys
     */
    function succeed($userQuest)
    {
        $this->ChangeLevelValue($userQuest, 'reputation', $this->reputation);
        $this->AddPropValue($this->player, 'exps', 25);
        $this->AddPropValue($this->player, 'coins', 20);
        $this->AddPropValue($this->player, 'health', 20);

        // Set Finish
        $userQuest->updateQuietly(['finished_at' => now()]);

        $this->dispatch('finishConfirm');
    }

    public function render()
    {
        return view('gamification.patients.'.$this->template);
    }

    /**
     * Handle different recovery modes.
     *
     * @param string $mode
     * @return void
     */
    public function recoveryMode(string $mode)
    {
        switch ($mode) {
            case 'giveup': //retry
                $this->dispatch('giveupConfirm');
                break;

            case 'revive':
                $data = ['caseId' => $this->userQuest->id, 'questId' => $this->userQuest->scenario_id];
                $this->dispatch('setReviveModal', data:$data);
                break;

            default:
                redirect()->route('lobby');
                break;
        }
    }

    /**
     * Handle user giving up on the quest.
     *
     * @return void
     */
    public function giveUp() //retry
    {
        $this->userQuest->updateQuietly([
            'reputation' => $this->reputation * -1,
            'is_revived' => false,
            // 'amount' => 0, // deprecated
            'finished_at' => now()
        ]);

        redirect()->route('lobby');
    }

    /**
     * Revive the patient using the specified item.
     *
     * @param int $itemId
     * @return void
     */
    public function revive(int $itemId)
    {
        $this->userQuest->update(['amount' => $this->quest->attributes['curr_health'], 'is_revived' => true, 'reputation' => null, 'revived_at' => now()]);

        $this->UpdateInvent($this->player->id, $itemId, -1);

        return $this->NormalSuccessAlert();
    }

    /**
     * User pays for recovery.
     *
     * @param int $price
     * @return void
     */
    public function recovery(int $price = 50) // Buy
    {
        if(!$this->HasStock($this->player, 'coins', $price)){
            return $this->EmptyStockAlert('coins');
        }

        $this->userQuest->updateQuietly([
            'amount' => $this->quest->attributes['curr_health'],
            'is_revived' => true,
            'reputation' => null,
            'revived_at' => now()
        ]);

        $this->AddPropValue($this->player, 'coins', $price * -1);
        
        return $this->NormalSuccessAlert();
    }

    /**
     * Redirect to quest finish page.
     *
     * @param int $key
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectFinish($key)
    {
        return redirect()->route('questfinish', $key);
    }

}
