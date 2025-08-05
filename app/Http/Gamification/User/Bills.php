<?php

namespace App\Http\Gamification\User;

use Illuminate\Support\Facades\Log;

use Livewire\Component;
use Livewire\Attributes\Url;

use App\Models\{User as UserModel, Transaction as Trans, Subscriber};
use App\Traits\WithSwal;

class Bills extends Component
{
    use WithSwal;

    protected UserModel $userModel;
    protected $userId;

    public $username;
    public $freeDay = 0;
    public $currentTier = 'Free Tier';
    public $maxDays = 14;

    #[Url]
    public $session;
    
    #[Url]
    public $res;

    public function boot()
    {
        $this->userId = auth()->id();
        $model = UserModel::find($this->userId);

        $this->userModel = $model;
        $this->username = $this->userModel->username;
    }

    public function mount()
    {
        /**
         * Upgrade Plan transaction received
         */
        if($this->session) { // succeeded only
            if($trans = Trans::whereTransType('subscription')
            ->whereTransCode($this->session)
            ->whereUserId($this->userId)
            ->whereStatus('paid')
            ->wherePaymentStatus('paid')
            ->whereNotNull('payment_amount')
            ->whereNotNull('payment_note')
            ->whereNotNull('paid_at')
            ->orderBy('id', 'DESC')
            ->first()){

                // Then activate the subscription
                if($subscribe = Subscriber::whereTransId($trans->id)->whereStatus('pending')->whereUserId($this->userId)->first()) {

                    $message = "You have upgraded to MedSnapp Premium.";
                    $this->SuccessfullAlert($message);

                    $subscribe->update(['status' => 'active']);

                    /**
                     * TODO :
                     * 2. send email notification
                     * 3. may send receipt
                     */
                }
            }else{
                Log::info('Session '.$this->session.' exists but transaction not found');
            }
        }
        
        $this->getDayLeft();
    }

    function getDayLeft()
    {
        $user = $this->userModel;
        $this->freeDay = $user->free_tier_left_days;

        if($user->hasSubscribed || $user->hasExpired) {
            $subscribe = $user->Subscribe->first();
            $this->freeDay = $user->subscribed_tier_left_days;
            $this->currentTier = $subscribe->current_tier;
            $this->maxDays = $user->max_days;
        }
    }

    protected function getData()
    {
        $history = Trans::whereUserId($this->userId)->wherePaymentStatus('paid')->orderBy('created_at', 'DESC')->get();

        return [
            'history' => $history,
            'item' => $this->userModel,
        ];
    }

    public function render()
    {
        return view('gamification.user.bills', $this->getData());
    }

    public function resetDemo()
    {
        Trans::whereUserId($this->userId)->forceDelete();
        Subscriber::whereUserId($this->userId)->forceDelete();

        $this->NormalSuccessAlert();
    }

}
