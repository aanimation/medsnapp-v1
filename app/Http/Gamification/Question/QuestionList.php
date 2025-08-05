<?php

namespace App\Http\Gamification\Question;

use Livewire\Component;

use App\Models\Question as QuestionModel;

class QuestionList extends Component
{

    protected $template = 'question-list';

    protected $listeners = [
        'refreshParent' => '$refresh',
        'delete' => 'deleteItem',
    ];

    public function getData()
    {
        $userId = auth()->id();
        $questions = QuestionModel::whereUserId($userId)->get();

        return [
            'questions' => $questions,
        ];
    }

    public function doAction(string $key, string $action = 'delete')
    {
        if($action === 'delete'){
            $this->dispatch($action.'Confirm', key:$key);
        }

        if($action === 'edit'){
            $this->dispatch('setQuestionKey', key:$key);
        }

        if($action === 'view'){
            $this->dispatch('setQuestionKey', key:$key);
        }
    }

    public function deleteItem($key)
    {
        QuestionModel::find($key)->delete();
        $this->dispatch('setQuestionReset');
    }

    public function render()
    {
        return view('gamification.questions.'.$this->template, $this->getData());
    }

}
