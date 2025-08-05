<?php
/* DEPRECATED */
namespace App\Http\Gamification\Other;

use PostHog\PostHog;
use Livewire\Component;
use PlutoLinks\Loops\Laravel\Facades\Loops;

use App\Traits\WithSwal;
use App\Models\ContactMsg;

class ContactMessage extends Component
{
    use WithSwal;

    protected $template = 'contact-msg';
    
    public $parts = ['Bug or software issue','Billing','Editor','Upgrading account','Feature Request','Something else','Delete my account'];

    public $priors = ['low','medium','high'];

    public $part, $subject, $message, $priority;

    protected function rules() {
        return [
            'part' => 'required',
            'subject' => 'required',
            'message' => 'required',
            'priority' => '',
        ];
    }

    public function submitMessage()
    {
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
    }

    public function render()
    {
        return view('gamification.other.'.$this->template);
    }

}
