<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{SoftDeletes, Model};
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
    use SoftDeletes;

    protected $table        = 'subscriptions';
    protected $guarded      = ['id'];
    protected $primaryKey   = 'tier_code';
    public    $incrementing = false;
    public    $timestamps   = true;
    protected $dates        = ['deleted_at'];
    public    $hidden       = ['id'];

    protected $casts = [
        'features' => 'json',
        'promo' => 'json',
    ];
}
