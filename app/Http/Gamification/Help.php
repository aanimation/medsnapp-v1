<?php

namespace App\Http\Gamification;

use PostHog\PostHog;
use Livewire\Component;

use PlutoLinks\Loops\Laravel\Facades\Loops;

use App\Traits\WithSwal;
use App\Models\ContactMsg;

class Help extends Component
{
    use WithSwal;

    protected $template = 'help';

    public $tab = 'video';

    public $videoUrl = 'https://www.youtube.com/embed/c_BoKQnydfI?rel=0';

    public $parts = ['Bug or software issue','Billing','Editor','Upgrading account','Feature Request','Something else','Delete my account'];
    public $priors = ['low','medium','high'];
    public $part, $subject, $message, $priority;

    protected function rules() {
        return [
            'part' => 'required',
            'subject' => 'required',
            'message' => 'required',
            'priority' => 'required',
        ];
    }

    protected function messages() {
        return [
            '*.required' => 'required',
        ];
    }

    public function submitMessage()
    {
        $this->tab = 'form';

        $this->validate();

        $userId = auth()->id();

        $data = [
            'part' => $this->part,
            'subject' => $this->subject,
            'message' => $this->message,
            'priority' => $this->priority,
            'user_id' => $userId ?? null,
        ];
        
        $item = ContactMsg::create($data);

        if(App()->isProduction()) {
            $user = auth()->user();
            $item = $item->fresh();

            // send email notification to admin
            $transactionId = config('loops.admin.contact-message');
            $dataVariables = [
                'name' => $user->Info->lastname ?? $user->name ?? 'User',
                'email' => $user->email,
                'username' => $user->username,
                'part' => $this->part,
                'subject' => $this->subject,
                'message' => $this->message,
                'priority' => $this->priority,
                'created_at' => $item->created_at,
            ];

            Loops::transactional()->send($transactionId, 'development@medsnapp.com', $dataVariables);
            sleep(1);
            Loops::transactional()->send($transactionId, 'contact@medsnapp.com', $dataVariables);
        }

        $this->NormalSuccessAlert();
        $this->reset();

        $this->tab = 'form';
    }

    protected function getData()
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

        $data = null;

        return [
            'data' => $data,
        ];
    }

    public function render()
    {
        return view('gamification.'.$this->template, $this->getData());
    }

}
