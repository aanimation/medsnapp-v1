<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAttsLog extends Model
{
    protected $table 		= 'users_atts_logs';
    protected $guarded  	= ['id'];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
