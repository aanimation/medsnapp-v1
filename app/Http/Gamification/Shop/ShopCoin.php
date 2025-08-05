<?php

namespace App\Http\Gamification\Shop;

use Livewire\Component;
use App\Traits\WithPlayerAtts;

class ShopCoin extends Component
{
    use WithPlayerAtts;

    public $template = 'shop-coin';

    public function render()
    {
        return view('gamification.shop.'.$this->template);
    }

}
