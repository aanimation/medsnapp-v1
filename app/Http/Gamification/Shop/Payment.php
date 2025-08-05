<?php
/*DEPRECATED*/
namespace App\Http\Gamification\Shop;

use Livewire\Component;
use Livewire\Attributes\Url;

use App\Models\{User, Transaction as Trans};

class Payment extends Component
{
    public $template, $status, $trans;

    #[Url]
    public $session;

    /**
     * url : /payment/stripe/{status}?session=1722605277
     */
    public function mount()
    {
        $this->template = $this->status; // status is route within param
        $this->session = $this->session; // session is url param only

        $trans = Trans::whereTransCode($this->session)
        ->whereUserId(auth()->id())
        ->whereStatus('paid')
        ->wherePaymentStatus('paid')
        ->whereNotNull('payment_amount')
        ->whereNotNull('payment_note')
        ->whereNotNull('paid_at')
        ->orderBy('id', 'DESC')
        ->first();

        if(is_null($trans) && $this->status !== 'cancel'){
            $this->template = 'nouser';
        }else{
            $this->trans = $trans;
        }
    }

    public function render()
    {
        return view('gamification.payments.'.$this->template);
    }

}
