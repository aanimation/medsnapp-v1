<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Stephenjude\FilamentBlog\Models\Post as PostModel;
use Stephenjude\FilamentBlog\Models\Category;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $category = null)
    {
        $cats = Category::all();

        if($category) {
            $items = PostModel::with(['author', 'category'])->whereHas('category', function($query) use ($category) {
                    $query->whereSlug($category);
                })
                ->orderBy('id', 'DESC')->get();
            return view('blog.index', compact('items', 'cats'));
        }

        $items = PostModel::with(['author', 'category'])->whereHas('category')->orderBy('id', 'DESC')->get();
        return view('blog.index', compact('items', 'cats'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $type, string $slug)
    {
        $cats = Category::all();
        $item = PostModel::with(['author', 'category'])->whereSlug($slug)->first();
        $relates = PostModel::whereBlogCategoryId($item->category->id)->whereNot('id', $item->id)->get([
            'title', 'slug', 'excerpt', 'banner', 'published_at'
        ]);

        return view('blog.detail', compact('item', 'relates', 'cats'));
    }


    /**
     * SHORTCUTs
     */
    public function medicinePage()
    {
        return $this->index('medicine');
    }

    public function guidesPage()
    {
        return $this->index('guides');
    }

    public function applicationsPage()
    {
        return $this->index('applications');
    }

}
