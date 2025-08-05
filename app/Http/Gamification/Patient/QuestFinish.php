<?php

namespace App\Http\Gamification\Patient;

use Livewire\Component;

use App\Models\{Scenario, UserQuest};

class QuestFinish extends Component
{
    protected string $template = 'quest-finish';

    public $player;
    public Scenario $quest;
    public UserQuest $userQuest;

    public function mount(int $key)
    {
        $userQuest = UserQuest::find($key);
        $this->userQuest = $userQuest;
        $this->quest = $userQuest->Quest;
    }

    public function render()
    {
        return view('gamification.patients.'.$this->template);
    }

}
