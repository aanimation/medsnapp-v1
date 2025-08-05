<?php

namespace App\Http\Gamification\Question;

use Livewire\Component;

class QuestionModal extends Component
{
    protected $template = 'question-modal';

    public array $answerLabels = ['A', 'B', 'C', 'D', 'E'];
    public array $data = [
        'clinical' => '',
        'question' => '',
        'answers' => [['text' => '', 'value' => false, 'note' => ''],], 
        'answer' => 0, 
        'explanation' => '',
        'topic' => '',
        'category_id' => null,
        'status' => ''
    ];

    protected $listeners = ['setQuestionModal'];
    public function setQuestionModal(array $data)
    {
        $this->data = $data;
        $this->dispatch('previewModalEvent', show:true);
    }

    public function render()
    {
        return view('gamification.questions.'.$this->template);
    }

}
