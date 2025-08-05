<?php

namespace App\Http\Gamification\User;

use Livewire\Component;

use App\Traits\{WithPlayerAtts, WithSwal};
use App\Models\{Badge as BadgeModel, UserBadge};

class Badges extends Component
{
    use WithPlayerAtts, WithSwal;

    public $badges;

    public function mount()
    {
        $this->badges = BadgeModel::withCount(['Assoc AS Assoc_count' => function($query){
                $query->where('user_id', auth()->id());
            },
        ])->orderBy('Assoc_count', 'DESC')->orderBy('order', 'ASC')->take(6)->get();
    }

    public function claimValue($id)
    {
        $player = auth()->user();

        UserBadge::find($id)->updateQuietly(['is_claimed' => true]);

        // rewards
        $this->AddPropValue($player, 'health', 10);
        $this->AddPropValue($player, 'exps', 5);

        $this->NormalSuccessAlert();
    }

    function getData()
    {
        return [
            'claimable' => UserBadge::with('Badge')->whereUserId(auth()->id())->whereIsClaimed(false)->get()
        ];
    }

    public function render()
    {
        return view('gamification.user.badges', $this->getData());
    }

}
