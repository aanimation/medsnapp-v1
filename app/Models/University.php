<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $table        = 'webometric_universities';
    // protected $table        = 'linkedin_universities';
    protected $guarded      = ['id'];
}
