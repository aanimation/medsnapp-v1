<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserInfo extends Model
{
    protected $table 		= 'users_info';
    protected $guarded  	= ['id'];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function Country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country', 'id');
    }

    public function University(): BelongsTo
    {
        return $this->belongsTo(University::class, 'university', 'id');
    }
}
