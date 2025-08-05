<?php

namespace App\Http\Gamification\User;

use Livewire\Component;

use App\Traits\{WithPlayerAtts, WithSwal};
use App\Models\Badge as BadgeModel;

class BadgesModal extends Component
{
    use WithPlayerAtts, WithSwal;

    public $cats;
    public $currCat = 'mine';
    public $search = '';

    public function mount()
    {
        $this->cats = BadgeModel::select('category')->distinct()->pluck('category');
    }

    public function changeCat(string $cat)
    {
        $this->currCat = $cat;
    }

    public function claimValue($key)
    {
        $player = auth()->user();

        $selected = BadgeModel::find($key);

        // not claimed yet
        if(!$selected->hasClaimed) {
            if($player->hasSubscribed) {
                $selected->Assoc->first()->updateQuietly(['is_claimed' => true]);

                // rewards
                $this->AddPropValue($player, 'health', 10);
                $this->AddPropValue($player, 'exps', 5);

                $this->NormalSuccessAlert();
            }else{
                /* redirect to subscription page then */
                return redirect()->route('subscription');
            }
        }
    }

    protected function getData()
    {
        $search = "%{$this->search}%";
        $cat = $this->currCat;

        $badges = BadgeModel::with(['Assoc'])
        ->when($cat != 'all',function ($query) use ($cat) {
            $query->where('category', $cat);
        })
        ->when($search != '', function ($query) use ($search) {
            $query->where('badge_name', 'like', $search);
        })
        ->orderBy('category', 'asc')
        ->get();

        if($cat === 'mine'){
            $badges = BadgeModel::whereHas('Assoc')->withCount('Assoc')->orderBy('Assoc_count', 'DESC')->orderBy('order', 'ASC')->get();
        }

        return [
            'badges' => $badges,
        ];
    }

    public function render()
    {
        return view('gamification.user.badges-modal', $this->getData());
    }

}
