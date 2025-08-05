<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reward extends Model
{
    use SoftDeletes;

    protected $table        = 'rewards';
    protected $guarded      = ['id'];
    public    $timestamps   = true;
    protected $dates        = ['deleted_at'];

    public function Inventory(): BelongsTo
    {
        return $this->belongsTo(Inventory::class, 'inv_id', 'id');
    }
}
