<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Waitlist extends Model
{
    use SoftDeletes;
    
    protected $table        = 'waitlist';    
    protected $guarded      = ['id'];
    public    $timestamps   = true;
    protected $dates        = ['deleted_at'];

    protected $casts = [
        'notes' => 'json',
        'completed_at' => 'datetime',
    ];

}
