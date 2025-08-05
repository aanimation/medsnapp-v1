<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class Question extends Model
{
    use SoftDeletes;

    protected $table        = 'questions';
    protected $guarded      = ['id'];
    protected $primaryKey   = 'skey';
    public    $incrementing = false;
    public    $timestamps   = true;
    protected $dates        = ['deleted_at'];
    protected $appends      = ['is_user_voted', 'is_user_vote_corrected'];

    protected $casts = [
        'answers' => 'json',
    ];

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
     * Defines a relationship to the QuestionCat model (category of the question).
     *
     * @return BelongsTo The relationship instance.
     */
    public function Category(): BelongsTo
    {
        return $this->belongsTo(QuestionCat::class, 'category_id', 'id');
    }

    /**
     * Retrieves the name of the associated category.
     *
     * @return string|null The name of the category, or null if not available.
     */
    public function getCategoryNameAttribute()
    {
        return $this->Category->name ?? null;
    }

    /**
     * Defines a relationship to the QuestionUser model (votes on the question).
     *
     * @return HasMany The relationship instance.
     */
    public function Vote(): HasMany
    {
        return $this->hasMany(QuestionUser::class, 'question_id', 'id');
    }

    /**
     * Checks if the authenticated user has voted on the question.
     *
     * @return bool True if the user has voted, false otherwise.
     */
    public function getIsUserVotedAttribute(): bool
    {
        /**
         * Note: Filtering by session_id may be required here.
         */
        $id = auth()->id();

        return $this->Vote->where('user_id', $id)
                          ->where('answer', '<>', null)
                          ->count() > 0;
    }

    /**
     * Checks if the authenticated user's vote is marked as correct.
     *
     * @return bool True if the user's vote is correct, false otherwise.
     */
    public function getIsUserVoteCorrectedAttribute(): bool
    {
        /**
         * Note: Filtering by session_id may be required here.
         */
        $id = auth()->id();

        return $this->Vote->where('user_id', $id)
                          ->where('is_corrent', 1)
                          ->count() > 0;
    }
}
