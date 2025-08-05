<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuestionStat extends Model
{
    protected $table        = 'question_stats';
    protected $guarded      = ['id'];
    protected $hidden       = ['created_at', 'updated_at'];
    protected $appends      = ['total', 'a_res', 'b_res', 'c_res', 'd_res', 'e_res'];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getTotalAttribute()
    {
        return $this->correct + $this->incorrect;
    }

    public function getAResAttribute()
    {
        if($this->total == 0) {
            return 0;
        }

        return intval(($this->a / $this->total) * 100);
    }

    public function getBResAttribute()
    {
        if($this->total == 0) {
            return 0;
        }

        return intval(($this->b / $this->total) * 100);
    }

    public function getCResAttribute()
    {
        if($this->total == 0) {
            return 0;
        }

        return intval(($this->c / $this->total) * 100);
    }

    public function getDResAttribute()
    {
        if($this->total == 0) {
            return 0;
        }

        return intval(($this->d / $this->total) * 100);
    }

    public function getEResAttribute()
    {
        if($this->total == 0) {
            return 0;
        }

        return intval(($this->e / $this->total) * 100);
    }
}
