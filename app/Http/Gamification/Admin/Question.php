<?php

namespace App\Http\Gamification\Admin;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Question as QuestionModel;

class Question extends Component
{
    use WithPagination;

    public $search = '';
    public $pageCount = 100;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'refreshParent' => '$refresh',
    ];

    public function doAction($key)
    {
        $this->dispatch('setQuestionKey', key: $key);
    }

    public function destroy($key)
    {
        QuestionModel::find($key)->delete();
    }

    public function getData()
    {
        $keySearch = "%{$this->search}%";

        $questions = QuestionModel::
        // with(['Category' => function($query) use($keySearch){
        //     $query->where('name', 'like', $keySearch);    
        // }])
        where('description', 'like', $keySearch)
        ->orWhere('question', 'like', $keySearch)
        ->orWhere('title', 'like', $keySearch)
        ->orderBy('id', 'DESC')
        ->paginate($this->pageCount);

        return [
            'data' => $questions,
        ];
    }

    public function render()
    {
        return view('gamification.admin.question', $this->getData());
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatePageCount($pageCount)
    {
        $this->pageCount = $pageCount;
    }
}