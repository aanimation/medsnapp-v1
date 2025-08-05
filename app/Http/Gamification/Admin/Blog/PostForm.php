<?php

namespace App\Http\Gamification\Admin\Blog;

use Illuminate\Support\Facades\Str;
use Livewire\Component;
use App\Traits\WithSwal;

use Stephenjude\FilamentBlog\Models\{
    Author as AuthModel,
    Category as CatModel,
    Post as PostModel
};

class PostForm extends Component
{
    use WithSwal;

    public $model, $categories, $authors;
    public $title, $slug, $excerpt, $content, $category, $author;

    protected $rules = [
        'title'       => 'required',
        'slug'        => 'required',
        'excerpt'     => 'required',
        'content'     => 'required',
        'category'    => 'required',
        'author'      => 'required',
    ];

    public function mount($slug)
    {
        $model = PostModel::whereSlug($slug)->first();
        $this->model = $model;
        $this->categories = CatModel::all();
        $this->authors = AuthModel::all();

        $this->title = $model->title;
        $this->slug = $model->slug;
        $this->excerpt = $model->excerpt;
        $this->content = $model->content;
        
        $this->category = CatModel::find($model->blog_category_id)->name;
        $this->author = AuthModel::find($model->blog_author_id)->name;

        $this->dispatch('setEditor', $this->content);
    }

    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    public function submit()
    {
        $msg = $this->validate();

        $authorId = AuthModel::where('name', $this->author)->first()->id;
        $catId = CatModel::where('name', $this->category)->first()->id;

        $input = [
            'blog_author_id' => $authorId,
            'blog_category_id' => $catId,
            'title' => $this->title,
            'slug' => $this->slug,
            'excerpt' => $this->excerpt,
            'content' => $this->content,
            'updated_at' => now(),
        ];

        PostModel::find($this->model->id)->update($input);

        return redirect()->back();

        // PostModel::updateOrCreate([
        //     'created_at' => $this->model->created_at,
        // ],$input);

        // $this->model = null;
    }

    public function render()
    {
        return view('gamification.admin.blog.post-form');
    }

}