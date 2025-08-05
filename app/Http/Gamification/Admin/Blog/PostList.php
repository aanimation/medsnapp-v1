<?php

namespace App\Http\Gamification\Admin\Blog;

use Livewire\{Component, WithPagination};

use Stephenjude\FilamentBlog\Models\Post as PostModel;

class PostList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'refreshParent' => '$refresh',
    ];

    public $pageCount = 100;

    public function getPostForm($slug)
    {
        return redirect()->route('post-form', $slug);
    }

    public function getData()
    {
        return [
            'data' => PostModel::paginate($this->pageCount),
        ];
    }

    public function render()
    {
        return view('gamification.admin.blog.post-list', $this->getData());
    }

}