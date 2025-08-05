<?php

namespace App\Http\Gamification\Admin;

use Livewire\Component;

use App\Models\Question;

class QuestionModal extends Component
{
    public $key;
    public array $answerLabels = ['A', 'B', 'C', 'D', 'E'];

    protected $listeners = ['setQuestionKey'];
    public function setQuestionKey($key)
    {
        $this->key = $key;
        $this->dispatch('previewModalEvent', show:true);
    }

    protected function getData()
    {
        return [
            'data' => Question::find($this->key),
        ];
    }

    public function render()
    {
        return view('gamification.admin.question-modal', $this->getData());
    }

}
