<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuestionSession extends Model
{
    use SoftDeletes;

    protected $table        = 'question_sessions';
    protected $guarded      = ['id'];

    protected $casts = [
        'question_ids' => 'array',
        'cat_ids' => 'array',
    ];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function Current(): BelongsTo
    {
        return $this->belongsTo(Question::class, 'last_question', 'skey');
    }
}
