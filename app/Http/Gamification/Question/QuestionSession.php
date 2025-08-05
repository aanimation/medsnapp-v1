<?php

namespace App\Http\Gamification\Question;

use PostHog\PostHog;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

use App\Traits\{WithSwal, WithPlayerAtts};
use App\Models\{Question as QuestionModel, QuestionSession as QuestionSessionModel, QuestionStat, QuestionUser};

class QuestionSession extends Component
{
    use WithSwal, WithPlayerAtts;

    protected $template = 'question-session';
    protected $user;

    public array $summary = ['correct' => 0, 'incorrect' => 0, 'score' => 0];
    public array $answerLabels = ['A', 'B', 'C', 'D', 'E'];
    public array $listIds = []; // array list or question keys
    public int $currentPosition;
    
    public ?QuestionModel $current;
    public QuestionSessionModel $currentSession;

    public ?string $improve;
    public ?string $review;

    public $vote, $stats;
    public array $hides = [];
    public $picked;
    public bool $isCorrect = false;
    public bool $isSubmitted = false;
    public $likeCount = 0;

    protected $temp = [
        'is_like' => false,
        'is_dislike' => false,
        'is_favorite' => false,
        'is_flag' => false,
        'is_correct' => false,
        'is_anonym' => false,
        'review' => null,
        'improve' => null,
        'answer' => null,
    ];

    protected $listeners = ['pickAnswer', 'hideAnswer'];

    public function boot()
    {
        $this->user = auth()->user();
    }

    public function mount($code)
    {
        if(App()->isProduction()) {
            PostHog::capture([
                'distinctId' => $this->user->username,
                'event' => '$set',
                'properties' => [
                    '$set' => ['name' => $this->user->name, 'email' => $this->user->email],
                    '$set_once' => ['initial_url' => url()->current()],
                ]
            ]);
        }

        $this->currentSession = QuestionSessionModel::with([
            'Current', 'Current.Vote'
        ])
        ->whereSessionCode($code)
        ->whereUserId($this->user->id)
        ->firstOrFail();

        // Force exit if Session ended
        if($this->currentSession->finished_at){
            return redirect()->route('questions');
        }

        // Prepare the list of questions
        $this->listIds = $this->__getItems();

        if(count($this->listIds) == 0){ // no questions
            $this->currentSession->update(['finished_at' => now()]);
            return redirect()->route('questions');
        }

        if(is_null($this->currentSession->last_question)) {
            $lastCurrentId = $this->listIds[0];
            $this->currentSession->update(['last_question' => $lastCurrentId]);
            $this->current = QuestionModel::find($lastCurrentId);
        }else{
            $this->current = $this->currentSession->Current;    
        }

        $this->currentPosition = array_search($this->current->skey, $this->listIds);
        $this->vote = $this->current->Vote->where('session_id', $this->currentSession->id)->count() ? $this->current->Vote->where('session_id', $this->currentSession->id)->first() : $this->temp;
        $this->isSubmitted = $this->vote['answer'] != null;

        if(isset($this->vote['answer'])){
            $this->picked = $this->answerLabels[$this->vote['answer']];
            $this->isCorrect = $this->vote['is_correct'];
            $this->__getLikeCount($this->current->id);
        }

        $this->getSummary();
    }

    public function getSummary()
    {
        $summary = QuestionUser::ForUser()->whereSessionId($this->currentSession->id)
        ->get();

        $correct = $summary->where('is_correct', true)->count();
        $incorrect = $summary->where('is_correct', false)->count();
        $this->summary['correct'] = $correct;
        $this->summary['incorrect'] = $incorrect;
        if($summary->count()){
            $this->summary['score'] = intval(($correct/$summary->count())*100);
        }

        $this->__getStatistic();
    }

    public function nextItem()
    {
        $this->_switchItem(1);
    }

    public function prevItem()
    {
        $this->_switchItem(-1);
    }

    function _switchItem(int $direction)
    {
        $this->currentPosition = $this->currentPosition + $direction;
        $lastCurrentId = $this->listIds[$this->currentPosition];

        $this->currentSession->update(['last_question' => $lastCurrentId]);
        $this->current = QuestionModel::find($lastCurrentId);

        //TODO: Optimise this part $this->current->Vote->where('session_id ...
        $this->vote = $this->temp;
        if($vote = $this->current->Vote->where('session_id', $this->currentSession->id)->first()){
            $this->vote = $vote->toArray();
        }

        $this->isSubmitted = $this->vote['answer'] != null;
        $this->isCorrect = $this->vote['is_correct'] ?? false;
        $this->picked = $this->answerLabels[$this->vote['answer']] ?? null;
        $this->review = $this->vote['review'] ?? null;
        $this->improve = $this->vote['improve'] ?? null;

        $this->__getLikeCount($lastCurrentId);
        $this->__getStatistic();

        // $this->reset('picked');
    }

    public function hideAnswer($answer)
    {
        $arr = $this->hides;
        if(count($arr) && in_array($answer, $arr)){
            unset($arr[array_search($answer, $arr)]);
        }else{
            $arr[] = $answer;
        }

        $this->hides = $arr;
    }

    public function addAction($column)
    {
        $this->_setData([
            $column => DB::raw('NOT questions_users.'.$column)
        ]);

        $this->vote[$column] = !$this->vote[$column];
    }

    public function addText($column)
    {
        $this->_setData([
            $column => $this->{$column},
        ]);

        $this->vote[$column] = $this->{$column};
    }

    public function pickAnswer($answer)
    {
        /*conflicted since jquery*/
        // $arr = $this->hides;
        // if(count($arr) && in_array($answer, $arr)){
        //     unset($arr[array_search($answer, $arr)]);
        //     $this->hides = $arr;
        // }

        $this->picked = $answer;
    }

    public function submitConfirm(string $key)
    {
        if($this->picked){
            $this->_submit($key);

            $this->getSummary();
        }
    }

    public function endSession()
    {
        $this->currentSession->update(['finished_at' => now()]);

        return redirect()->route('questions');
    }

    function _submit($key)
    {
        if( $this->_setData() ){
            $this->isSubmitted = true;
            $this->reset('hides');
        }
    }

    function __getAnswerStatus(array $answers, int $answer)
    {
        return !is_null($answers[$answer]['value']);
    }

    function __getStatistic()
    {
        $this->reset('stats');
        return $this->stats = QuestionStat::whereQuestionId($this->current->id)->first();
    }

    function __getLikeCount($questionId)
    {
        $this->likeCount = QuestionUser::whereQuestionId($questionId)->whereIsLike(1)->count();
    }

    function _setData($input = null)
    {
        $question = $this->current;

        if(is_null($input)){
            $answerInt = array_search($this->picked, $this->answerLabels);
            $this->isCorrect = $this->__getAnswerStatus(json_decode($question->answers, true), $answerInt);

            $input = [
                'answer' => $answerInt,
                'is_correct' => $this->isCorrect,
            ];

            if($this->isCorrect){
                $this->CorrectAnswerAlert();
                $this->AddPropValue($this->user, 'coins', 1);
                $this->AddPropValue($this->user, 'exps', 1);
            }else{
                $this->IncorrectAnswerAlert();
            }
        }

        $inits = [
            'user_id' => $this->user->id,
            'question_id' => $question->id,
            'session_id' => $this->currentSession->id,
        ];

        return QuestionUser::updateOrCreate($inits, $input);
    }

    public function render()
    {
        return view('gamification.questions.'.$this->template);
    }

    function __getItems()
    {
        $items = $orderedIds = null;
        $userId = $this->user->id;
        $currentSessionId = $this->currentSession->id;

        if($questionIds = $this->currentSession->question_ids){
            $items = QuestionModel::whereIn('id', $questionIds);
            $orderedIds = $questionIds;
        }elseif($catIds = $this->currentSession->cat_ids){
            $items = QuestionModel::whereIn('category_id', $catIds)->inRandomOrder();
        }else{
            $items = QuestionModel::whereNull('deleted_at')->take(10)->inRandomOrder();
        }
        
        $items = $items->with(['Vote' => function($item) use($currentSessionId, $userId){
            return $item->where(['user_id' => $userId, 'session_id' => $currentSessionId]);
        }])
        ->whereStatus('published')
        ->withCount('Vote');

        if($orderedIds) {
            return $items->get()->sortBy(function($item) use($orderedIds){
                return array_search($item->id, $orderedIds);
            })->pluck('skey')->toArray();
        }

        return $items->pluck('skey')->toArray();
    }

}