<?php

namespace App\Http\Gamification;

use Illuminate\Support\Facades\{DB, Log};
use Exception;

use PostHog\PostHog;
use Livewire\Component;
use PlutoLinks\Loops\Laravel\Facades\Loops;

use App\Traits\{WithReferral, WithSwal};
use App\Models\{Invite as InviteModel, User};

class Invite extends Component
{
    use WithReferral, WithSwal;

    protected $template = 'invite';

    public $status = 'down';
    
    public $isCopied = false;
    public $email;

    public User $currentUser;
    public string $appUrl;
    public $refCode;
    public $referredUsers;
    
    protected function rules() {
        return [
            'email' => 'required|email|unique:invites,email|unique:users,email',
        ];
    }

    public function messages() 
    {
        return [
            '*.unique' => 'This email has recorded on our system. Please try another!',
        ];
    }

    public function setStatus($status)
    {
        $this->status = $status === 'down' ? 'up' : 'down';
    }

    public function mount()
    {
        if(App()->isProduction()) {
            PostHog::capture([
                'distinctId' => auth()->user()->username,
                'event' => '$set',
                'properties' => [
                    '$set' => ['name' => auth()->user()->name, 'email' => auth()->user()->email],
                    '$set_once' => ['initial_url' => url()->current()],
                ]
            ]);
        }

        $this->appUrl = (config('app.platform_url') ?? config('app.url')).'/signup';
        $this->currentUser = auth()->user();
        $this->refCode = $this->currentUser->ref_code;
        $this->referredUsers = $this->getReferredUsers($this->currentUser->id);

        if(!$this->refCode){
            $this->generateNewCode();
        }
    }

    public function updated($property, $value)
    {
        $this->validateOnly($property);
    }

    protected function getData()
    {
        $user = auth()->user();
        $data = InviteModel::whereUserId($user->id)->get();

        return [
            'user' => $user,
            'data' => $data,
        ];
    }

    public function sendInvitation()
    {
        $this->validate();

        $userId = auth()->id();

        $invite = new InviteModel();
        $invite->user_id = $userId;
        $invite->email = $this->email;
        $invite->status = 'pending';
        $invite->save();

        $this->SuccessfullAlert('Invitation sent');

        $this->reset('email');
    }

    public function resendInvitation($id)
    {
        $invite = InviteModel::find($id);

        $activateLink = route('invite-player', $invite->id);
        try{
            $transactionId = config('loops.transactional.reminder');
            $dataVariables = ['link' => $activateLink, 'sender' => $invite->User->Info->firstname ?? $invite->User->Info->lastname ?? $invite->User->name]; 

            Loops::transactional()->send($transactionId, $invite->email, $dataVariables);
        }catch(Exception $e) {
            Log::warning(['message' => $e->getMessage(), 'loc' => 'invite reminder']);
        }
        
        $invite->update(['sent_count' => DB::raw('invites.sent_count + 1')]);

        $this->SuccessfullAlert('Invitation resent');
    }

    public function render()
    {
        return view('gamification.'.$this->template, $this->getData());
    }

    public function copyToClipboard()
    {
        $urlLink = "{$this->appUrl}?ref={$this->refCode}";
        $this->dispatch('copyToClipboard', url: $urlLink);

        $this->isCopied = true;
    }

    function generateNewCode()
    {
        $refCode = $this->generateCode();
        $this->currentUser->updateQuietly(['ref_code' => $refCode]);
        $this->refCode = $refCode;
    }

    function coinByInvite($mailCount)
    {
        $rewards = [1=>5, 10, 15,20,25,30,35,40,45,50];
        
        return $rewards[$mailCount] ?? null;
    }

    function coinByLevel($level)
    {
        $rewards = [1=>10, 20, 30, 40, 50];
        
        return $rewards[$level] ?? null;
    }

}


