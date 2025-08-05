<?php

namespace App\Http\Gamification\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\{WithSwal, WithPlayerAtts};

use App\Models\{User as UserModel, UserBadge, UserInv, UserQuest, UserQuestInv, Subscription, Subscriber};

class UserDetail extends Component
{
    use WithPagination, WithSwal, WithPlayerAtts;

    public $model;

    public $subscriptions, $selectedTierCode;
    public $subjectAmount = 0, $selectedSubject;

    public $freeDay = 0;
    public $currentTier = 'Free Tier';
    public $maxDays = 14;

    public function mount($key)
    {
        $this->model = UserModel::with(['Subscribe','Subscribe.Subscription'])->where('skey', $key)->first();

        if(is_null($this->model)) {
            return redirect()->route('user-list');
        }

        $this->subscriptions = Subscription::where('tier_name', '<>', 'Free')->whereStatus('active')->get();

        $this->getDayLeft();
    }

    public function resetUser(bool $isHardDelete = false)
    {
        $user = $this->model;

        $user->rank = null;
        $user->reputation = 0;
        $user->level = 1;
        $user->is_new = true;
        $user->is_active = false;
        // $user->is_locked = 1;
        // $user->remember_token = null;
        $user->save();

        if($atts = $user->Atts) {
            $atts->delete();
        }

        UserInv::whereUserId($user->id)->forceDelete();
        UserQuestInv::whereUserId($user->id)->forceDelete();

        if($isHardDelete){
            if($atts = $user->Atts) {
                $atts->forceDelete();
            }

            UserBadge::whereUserId($user->id)->forceDelete();
            UserQuest::whereUserId($user->id)->forceDelete();
            Subscriber::whereUserId($user->id)->forceDelete();
            $user->updateQuietly(['is_deleted' => true]);
            $user->forceDelete();
        }else{
            UserBadge::whereUserId($user->id)->delete();
            UserQuest::whereUserId($user->id)->delete();
            Subscriber::whereUserId($user->id)->delete();
            // $user->delete();
        }

        $this->NormalSuccessAlert();

        return redirect()->route('user-list');
    }

    function getDayLeft()
    {
        $user = $this->model;
        $this->freeDay = $user->free_tier_left_days;

        if($user->hasSubscribed) {
            $subscribe = $user->Subscribe->first();
            $this->freeDay = $user->subscribed_tier_left_days;
            $this->currentTier = $subscribe->current_tier;
            $this->maxDays = $user->max_days;
        }
    }

    /**
     * Manually add user into a subscribe
     */
    public function subscribeUser()
    {
        if($selected = Subscription::whereTierCode($this->selectedTierCode)->first()){

            Subscriber::updateOrCreate([
                'trans_id' => 0,
                'user_id' => $this->model->id,
                'subscription_id' => $selected->id,
            ],[
                'start_date' => now(),
                'end_date' => now()->addMonths($selected->size),
                'status' => 'active',
            ]);

            $this->reset('selectedTierCode');

            $this->NormalSuccessAlert();
        }else{
            $this->UnsuccessfullAlert('No subscription selected');
        }
    }

    /**
     * Manually subsidy to user
     */
    public function subventionUser()
    {
        if($this->model->Atts && $this->subjectAmount > 0 && $this->selectedSubject){
            $this->AddPropValue($this->model, $this->selectedSubject, $this->subjectAmount);

            $this->reset('subjectAmount', 'selectedSubject');
            
            $this->NormalSuccessAlert();
        }else{
            $this->UnsuccessfullAlert('No subvention selected');
        }
    }

    public function render()
    {
        return view('gamification.admin.user-detail');
    }

}