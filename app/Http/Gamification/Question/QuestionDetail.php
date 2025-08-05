<?php

namespace App\Http\Gamification\Question;

use PostHog\PostHog;
use Livewire\Component;
use App\Models\Question as QuestionModel;

class QuestionDetail extends Component
{
    protected $template = 'question-detail';
    public $answerLabels = ['A', 'B', 'C', 'D', 'E'];

    public string $key;
    public QuestionModel $question;
    public array $answers;

    public function mount()
    {
        $question = QuestionModel::find($this->key);
        $this->question = $question;
        $this->answers = json_decode($question->answers, true);

        if(App()->isProduction()) {
            PostHog::capture(['distinctId' => auth()->user()->username ?? 'guest', 'event' => 'question detail']);
        }
    }

    public function render()
    {
        return view('gamification.questions.'.$this->template);
    }

}
