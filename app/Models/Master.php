<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    protected $table        = 'masters';
    protected $guarded      = ['id'];

    protected $casts = [
        'content' => 'array',
    ];
}
