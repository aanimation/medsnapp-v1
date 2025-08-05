<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuestionCat extends Model
{
    protected $table        = 'question_cats';
    protected $guarded      = ['id'];
    protected $appends      = ['question_count', 'children_count'];

    public function Content(): HasMany
    {
        return $this->hasMany(Question::class, 'category_id', 'id');
    }

    public function Children(): HasMany
    {
        return $this->hasMany(QuestionCat::class, 'parent_id', 'id');
    }

    public function getQuestionCountAttribute()
    {
        return $this->Content->count();
    }

    public function getChildrenCountAttribute()
    {
        return $this->Children->count();
    }
}
