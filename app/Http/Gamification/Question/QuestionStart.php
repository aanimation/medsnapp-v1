<?php

namespace App\Http\Gamification\Question;

use PostHog\PostHog;
use Livewire\Component;
use Illuminate\Support\Arr;

use App\Models\{Question, QuestionCat, QuestionSession, QuestionUser};
use App\Traits\WithSwal;

class QuestionStart extends Component
{
    use WithSwal;

    protected $template = 'question-start';

    public $lastSession;
    public bool $isResetable = false;
    public bool $isEmptySession = false;

    public bool $selectedAllCat = false;
    public $selectedCat = [];
    public $selectedSubCat = [];
    public $selectedTopic = [];

    public $collectCat = [];
    public $collectSubCat = [];
    public $collectTopic = [];

    public $searchTopic;

    protected $listeners = [
        'resetQuestion' => 'resetQuestion',
        'refreshParent' => '$refresh',
    ];

    public function rules(){
        return [
            'selectedAllCat' => '',
            'selectedCat.*' => '',
            'selectedSubCat.*' => 'required',
        ];
    }

    public function messages() 
    {
        return [
            'selectedSubCat.*' => 'No category selected',
        ];
    }

    public function mount()
    {
        $user = auth()->user();
        $query = QuestionSession::query();

        if($lastSession = $query->clone()->whereNull('finished_at')->whereUserId($user->id)->orderBy('id', 'desc')->first()) {
            // get last session where not finished and not expired after 1 hour inactivity
            if($lastSession->created_at > now()->subHour() || $lastSession->updated_at > now()->subHour()) {
                $this->lastSession = $lastSession;
            }else{
                $lastSession->updateQuietly(['finished_at' => now()]);
            }
        }


        $this->isResetable = $user->hasSubscribed;
    }

    public function updatedSelectedTopic($value, $questionId)
    {
        $this->selectedAllCat = false;
        $this->selectedTopic[$questionId] = $value;
    }

    public function updatedSelectedAllCat($valueAll)
    {
        $parents = QuestionCat::whereNull('parent_id')->pluck('id');
        foreach ($parents as $par) {
            $this->selectedCat[$par] = $valueAll == 'on' ? true : false;
        }

        $subs = QuestionCat::whereNotNull('parent_id')->pluck('id');

        foreach ($subs as $sub) {
            $this->selectedSubCat[$sub] = $valueAll == 'on' ? true : false;
        }
    }

    public function updatedSelectedCat($value, $catId)
    {
        $this->selectedAllCat = false;
        $subs = QuestionCat::where('parent_id', $catId)->pluck('id');

        foreach ($subs as $sub) {
            $this->selectedSubCat[$sub] = $value;
        }
    }

    public function updatedSelectedSubCat($value, $subId)
    {
        $this->selectedAllCat = false;
        $catId = QuestionCat::find($subId)->parent_id;
        $this->selectedCat[$catId] = false;
        $this->selectedSubCat[$subId] = $value;
    }

    public function getData()
    {
        $cats = QuestionCat::with(['Children', 'Children.Content'])
        ->withCount('Content')
        ->orderBy('name', 'asc')
        ->get();

        $answered = QuestionUser::whereUserId(auth()->id())->distinct('question_id')->orderBy('is_correct', 'desc')->get();

        $correctAnswer = $answered->where('is_correct', true)->count();
        $incorrectAnswer = $answered->where('is_correct', false)->count();
        $answeredCount = $answered->count();
        $averageCorrect = 0;
        if($answeredCount > 0){
            $averageCorrect = intval(($correctAnswer/$answeredCount)*100);
        }

        // by topics
        $keySearch = "%{$this->searchTopic}%";
        $topicsFound = Question::whereNotNull('description')->where('description', '<>', '')
        ->when(strlen($keySearch) >= 5, function($query) use($keySearch){
            $query->where('description', 'like', $keySearch);
        })
        ->whereStatus('published')
        //->take(10) // limit to show only
        ->get()->unique('description');
        $topicCollection = Question::whereIn('id', array_keys(array_filter($this->selectedTopic)))->whereStatus('published')->pluck('description');

        return [
            'cats' => $cats,
            'answeredCount' => $answeredCount,
            'correctAnswer' => $correctAnswer,
            'incorrectAnswer' => $incorrectAnswer,
            'averageCorrect' => $averageCorrect,
            'topicsFound' => $this->searchTopic ? $topicsFound : collect([]),
            // 'topicsFound' => $topicsFound,
            'topicCollection' => $topicCollection,
        ];
    }

    public function clearTopic()
    {
        $this->reset('selectedTopic');
    }

    public function preResetQuestion()
    {
        return $this->dispatch('preResetQuestion');
    }

    public function resetQuestion()
    {
        $userId = auth()->id();

        $sessions = QuestionSession::whereUserId($userId)->whereNull('finished_at');
        if($sessions->count()) {
            $sessions->update(['finished_at' => now()]);
        }

        QuestionUser::whereUserId($userId)->delete();

        $this->NormalSuccessAlert();

        $this->reset('lastSession');
    }

    public function startSession(bool $isNew = true)
    {
        if(!$isNew) { // RESUME
            return redirect()->route('question-session', $this->lastSession->session_code);
        }

        $user = auth()->user();
        $isPremium = $user->hasSubscribed;
        $questionIds = null;
        $size = 999;

        // collect ids of CORRECTED questions
        $myQuestionIds = QuestionUser::whereUserId($user->id)->whereIsCorrect(true)->pluck('question_id');

        // Limit free user only 2 sessions or 10 question in total
        if(!$isPremium) {
            $size = 10;
            $sessions = QuestionSession::whereUserId($user->id);
            // if($sessions->count() >= 2 || $myQuestionIds->count() >= $size) {
            if($myQuestionIds->count() >= $size) {
                return $this->dispatch('openUpgradeOffers');
            }
        }

        if(count($this->selectedSubCat)){
            $catIds = array_keys(array_filter($this->selectedSubCat));
            $questionIds = Question::whereIn('category_id', $catIds)->whereStatus('published')->whereNotIn('id', $myQuestionIds)->take($size)->pluck('id');
        }else{
            $questionIds = Question::whereNotIn('id', $myQuestionIds)->whereStatus('published')->take($size)->pluck('id');
        }

        // by topics then
        if(count($this->selectedTopic)){
            $byTopicIds = collect(array_keys(array_filter($this->selectedTopic)));
            // get all descriptions by selectedTopic ids
            $questionByTopicSearch = Question::whereIn('id', $byTopicIds)->pluck('description');
            // get all ids by query above
            $questionIds = Question::whereStatus('published')->whereIn('description', $questionByTopicSearch)->inRandomOrder()->take($size)->pluck('id');
        }

        // new fresh start with 10 questions
        if(is_null($questionIds)){
            $questionIds = Question::whereStatus('published')->inRandomOrder()->take($size)->pluck('id');
        }

        $newSession = QuestionSession::create([
            'user_id' => auth()->id(),
            // 'cat_ids' => $catIds, // DEPRECATED
            'question_ids' => Arr::shuffle($questionIds->toArray()),
        ]);

        $newSession->fresh();
        // $this->lastSession = $newSession;
        $this->isEmptySession = true;

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
        
        return redirect()->route('question-session', $newSession->session_code);
    }

    public function render()
    {
        return view('gamification.questions.'.$this->template, $this->getData());
    }

}
