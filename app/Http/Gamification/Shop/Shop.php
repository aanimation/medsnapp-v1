<?php

namespace App\Http\Gamification\Shop;

use Livewire\Component;
use Livewire\Attributes\Url;

use App\Traits\{WithPlayerAtts, WithPlayerInvents, WithSwal};
use App\Models\{Inventory, Transaction as Trans};

class Shop extends Component
{
    use WithPlayerAtts, WithPlayerInvents, WithSwal;

    protected $template = 'shop';

    public $tabs = ['all' => 'Search', 'investigation' => 'Investigation', 'treatment' => 'Treatment', 'recovery' => 'Revive', 'currency' => 'Currency'];

    public $currentItem = null;
    public $search = '';
    public $isSearch = false;
    public $currType = 'investigation';
    public $currCat = 'all';

    #[Url]
    public $session;
    
    #[Url]
    public $res;

    public function mount()
    {
        if($this->session) {
            if(is_null($this->res)){
                if($trans = Trans::whereTransType('currency')
                ->whereTransCode($this->session)
                ->whereUserId(auth()->id())
                ->whereStatus('paid')
                ->wherePaymentStatus('paid')
                ->whereNotNull('payment_amount')
                ->whereNotNull('payment_note')
                ->whereNotNull('paid_at')
                ->orderBy('id', 'DESC')
                ->first()){
                    $message = "Purchase {$trans->quantity} {$trans->subject}  succeded";
                    $this->SuccessfullAlert($message);
                }
            }else{
                if($trans = Trans::whereTransType('currency')
                ->whereTransCode($this->session)
                ->whereStatus('unpaid')
                ->whereUserId(auth()->id())
                ->orderBy('id', 'DESC')
                ->first()){
                    $trans->updateQuietly(['status' => 'cancelled', 'cancelled_at' => now()]);
                    $message = "Purchase {$trans->quantity} {$trans->subject} cancelled";
                    $this->SuccessfullAlert($message, 'Info!');
                }
            }
        }
    }

    public function updatedSearch()
    {
        $this->reset('currentItem');
    }

    public function toggleSearch()
    {
        $this->isSearch = !$this->isSearch;
        $this->reset('currentItem');
    }

    public function changeType(string $type = 'all')
    {
        $this->reset('search', 'currentItem', 'currCat');
        $this->currType = $type;
    }

    public function changeCat(string $cat = 'all')
    {
        $this->reset('search', 'currentItem');
        $this->currCat = $cat;
    }

    public function selectItem($key, bool $multi = false)
    {
        $this->reset('currentItem');
        $this->currentItem = Inventory::find($key);
        if($this->currentItem->type === 'currency'){
            $this->dispatch('setPurchaseItem', key:$key);
        }elseif($multi){
            $this->dispatch('setRouteModal', key:$key);
        }else{
            $this->dispatch('setShopModal', key:$key);
        }
    }

    protected function getData()
    {
        if($this->search !== ''){
            $this->currType = $this->currCat = 'all';
        }
        // else{
        //     $this->reset('currType', 'currCat');
        // }

        $cat = $this->currCat;
        $type = $this->currType;
        $search = "%{$this->search}%";

        $inventories = Inventory::ForShopQuery()
            ->when($type != 'all', function ($query) use ($type) {
                    $query->where('type', $type);
            })
            ->when($cat != 'all', function ($query) use ($cat) {
                    $query->where('category', $cat);
            })
            ->where('name', 'like', $search)
            ->where('deleted_at', null)
            ->whereIsSibling(false)
            ->get();

        return [
            'inventories' => $inventories->where('type', '<>', 'examination'),
        ];
    }

    public function render()
    {
        return view('gamification.shop.'.$this->template, $this->getData());
    }

}
