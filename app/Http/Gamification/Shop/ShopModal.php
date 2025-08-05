<?php

namespace App\Http\Gamification\Shop;

use PostHog\PostHog;
use Livewire\Component;

use App\Traits\{WithPlayerAtts, WithPlayerInvents};
use App\Models\Inventory;

class ShopModal extends Component
{
    use WithPlayerAtts, WithPlayerInvents;

    protected $template = 'shop-modal';

    public $item;
    public $message;

    protected $listeners = ['setShopModal'];

    public function setShopModal(string $key)
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

        $this->item = Inventory::find($key);
        $this->dispatch('shopModalEvent', show:true);
    }

    public function buyItem(string $key, int $size = 1)
    {
        $item = Inventory::find($key);
        $user = auth()->user();

        if(!$user->hasSubscribed && $item->type === 'recovery') {
            return redirect()->route('subscription');
        }else{

            if($user->Atts->coins >= $item->price){
                $this->AddPropValue($user, 'coins', $item->price * -1);
                $this->UpdateInvent($user->id, $item->id, $size);
            }else{
                $this->message = 'Coins not enough!!!';
            }
        }
    }

    public function render()
    {
        return view('gamification.shop.'.$this->template);
    }

}
