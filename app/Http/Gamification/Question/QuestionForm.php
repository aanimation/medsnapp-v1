<?php

namespace App\Http\Gamification\Question;

use Exception;
use Illuminate\Support\Facades\Log;

use PostHog\PostHog;
use Livewire\Component;

use App\Traits\{WithSwal, WithPlayerAtts};
use App\Models\{QuestionCat, Question as QuestionModel};

class QuestionForm extends Component
{
    use WithSwal, WithPlayerAtts;

    public bool $isAdmin = false;

    protected $template = 'question-form';
    public $maxQuestion = 5;
    public $keyToEdit;

    public $clinical, $title, $category_id, $question;
    public $answer;
    public $answers = [
        ['text' => null, 'value' => null, 'note' => null],
        ['text' => null, 'value' => null, 'note' => null],
        ['text' => null, 'value' => null, 'note' => null],
        ['text' => null, 'value' => null, 'note' => null],
        ['text' => null, 'value' => null, 'note' => null],
    ];
    public $answerLabels = ['A', 'B', 'C', 'D', 'E'];
    public $explanation, $topic, $description;

    protected $listeners = ['setQuestionKey', 'setQuestionReset'];

    public function mount(string $key = null)
    {
        $this->isAdmin = auth()->user()->is_admin || auth()->user()->is_operator;

        if($this->checkQuestionAttemptToday() && !$this->isAdmin){
            $this->template = 'question-close';
        }

        // Edit question on admin panel
        if($key && $this->isAdmin){
            $this->setQuestionKey($key);
        }

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
    }

    public function setQuestionKey($key)
    {
        $this->keyToEdit = $key;
        $item = QuestionModel::find($key);

        $this->clinical = $item->clinical_vignette;
        $this->title = $item->title;
        $this->question = $item->question;
        $this->category_id = $item->category_id;
        $this->explanation = $item->explanation;
        $this->topic = $item->topic;
        $this->description = $item->description;
        $this->answers = json_decode($item->answers, true);

        foreach($this->answers as $idx => $answer){
            if($answer['value'] !== null){
                $this->answer = $idx;
                break;
            }
        }

        $this->dispatch('setEditor', $this->clinical);
        $this->dispatch('setExplainEditor', $this->explanation);
    }

    public function setQuestionReset()
    {
        $this->resetForm();
    }

    protected function rules() {
        return [
            'title'         => '',
            'clinical'      => 'required',
            'question'      => 'required|max:255',
            'explanation'   => '',//'required|min:30',
            'topic'         => 'required',
            'description'   => '',
            'answers'       => 'required|array|min:5|max:5',
            'answers.*.text'=> 'required|string|min:3',
            'answers.*.value'=> '',
            'answer'        => 'required',
            'answers.*.note'=> 'required|string|min:3',
            'category_id'   => 'exists:question_cats,id'
        ];
    }

    protected function messages() 
    {
        return [
            'answer.required' => 'Choose which answer is correct.',
            '*.required' => 'This field is missing.',
            'answers.*.*.required' => 'This field is missing.',
            'answers.*.text.min' => 'This field at least 10 characters length.',
            'category_id.exists' => 'This field is missing.',
        ];
    }

    public function resetForm()
    {
        $this->dispatch('resetEditor');
        $this->dispatch('resetExplainEditor');
        $this->reset();
    }

    public function preview()
    {   
        $this->dispatch('setQuestionModal', data: [
            'clinical' => $this->clinical,
            'title' => $this->title,
            'clinical' => $this->clinical,
            'question' => $this->question,
            'answers' => $this->answers,
            'answer' => $this->answer,
            'explanation' => $this->explanation,
            'topic' => $this->topic,
            //'description' => $this->description,
            'category_id' => $this->category_id,
        ]);
    }

    public function submit(string $status = 'pending')
    {
        $this->validate();

        // Set correct answer
        $this->answers[$this->answer]['value'] = true;

        $new = [
            'clinical_vignette' => $this->clinical,
            'title'             => QuestionCat::find($this->category_id)->name,
            'question'          => $this->question,
            'explanation'       => $this->explanation,
            'topic'             => $this->topic,
            'description'       => $this->description,
            'answers'           => json_encode($this->answers),
            'user_id'           => auth()->id(),
            'category_id'       => $this->category_id,
            'status'            => $status,
            //'status'            => $this->isAdmin ? 'published' : ($status ?? 'pending'),
        ];

        try{
            $init = ['skey' => $this->keyToEdit];
            if(!$this->keyToEdit){
                $init = $new;
            }
            $status = QuestionModel::updateOrCreate($init, $new);

        }catch(Exception $e) {
            Log::error($e->getMessage());
            $this->AddQuestionErrorAlert();
        }

        if(!$this->isAdmin){ // User only can save as draft
            return $this->_afterSubmit($new);
        }

        redirect()->route('question-list');
    }

    function _afterSubmit($new)
    {
        $user = auth()->user();
        if($new['status'] != 'draft'){
            if($this->keyToEdit){
                $this->UpdateQuestionAlert();
            }else{
                $this->AddQuestionAlert();
                $this->AddPropValue($user, 'coins', 5);
                $this->AddPropValue($user, 'exps', 2);
            }
        }else{
            $this->DraftQuestionAlert();
        }
        
        $this->resetForm(); // reset form only on edit question of user

        $this->dispatch('refreshParent');

        if($this->checkQuestionAttemptToday()){
            $this->template = 'question-close';
        }
    }

    public function render()
    {
        $cats = QuestionCat::all();
        return view('gamification.questions.'.$this->template, ['categories' => $cats]);
    }

    function checkQuestionAttemptToday(): bool
    {
        $questionByTodayCount = QuestionModel::whereUserId(auth()->id())->whereDate('created_at', now()->today())->count();

        return $questionByTodayCount >= $this->maxQuestion;
    }

}
