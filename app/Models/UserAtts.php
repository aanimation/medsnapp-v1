<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class UserAtts extends Model
{
    protected $table 		= 'users_atts';
    protected $guarded  	= ['id'];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function Users(): HasMany
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }
}
