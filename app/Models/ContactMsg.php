<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactMsg extends Model
{
    protected $table        = 'contact_msg';
    protected $guarded      = ['id'];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
