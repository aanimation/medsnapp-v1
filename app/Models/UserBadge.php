<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserBadge extends Model
{
    protected $table 		= 'users_badges';
    protected $guarded  	= ['id'];

    protected $casts = [
        'is_claimed' => 'boolean',
    ];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function Badge()
    {
        return $this->belongsTo(Badge::class, 'badge_id', 'id');
    }

}
