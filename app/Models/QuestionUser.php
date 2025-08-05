<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Builder, Model, SoftDeletes};
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class QuestionUser extends Model
{
    use SoftDeletes;

    protected $table        = 'questions_users';
    protected $guarded      = ['id'];

    /**
     * Defines a relationship to the User model.
     *
     * @return BelongsTo The relationship instance.
     */
    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Defines a relationship to the Question model.
     *
     * @return BelongsTo The relationship instance.
     */
    public function Question(): BelongsTo
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }

    /**
     * Defines a relationship to the QuestionSession model.
     *
     * @return BelongsTo The relationship instance.
     */
    public function Session(): BelongsTo
    {
        return $this->belongsTo(QuestionSession::class, 'session_id', 'id');
    }

    public function scopeForUser(Builder $query): Builder
    {
        $userId = auth()->id();
        return $query->where('user_id', $userId)->where('answer', '<>', null)->orderBy('is_correct', 'desc');
    }
}
