<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};
use Illuminate\Support\Facades\Auth;

class Scenario extends Model
{
    use SoftDeletes;
    
    protected $table        = 'scenarios';
    protected $guarded      = ['id'];
    protected $primaryKey   = 'skey';
    public    $incrementing = false;
    public    $timestamps   = true;
    protected $dates        = ['deleted_at'];
    public    $appends      = ['userQuestExists', 'userQuestSucceed', 'userQuestFailed'];

    protected $casts = [
        // 'attempts' => 'json',
        'attributes' => 'json',
        'is_trial' => 'boolean',
    ];

    /**
     * Defines a relationship to the User model for the user who created the scenario.
     *
     * @return BelongsTo The relationship instance.
     */
    public function CreateBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * Defines a relationship to the User model for the user who approved the scenario.
     *
     * @return BelongsTo The relationship instance.
     */
    public function ApproveBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by', 'id');
    }

    
    /* Relationships */

    // NOTE : dont open this relationship, to make data secure
    // public function Correct(): HasMany
    // {
    //     return $this->hasMany(InvQuestValue::class, 'scenario_id', 'id');
    // }

    /**
     * Defines a relationship to the UserQuest model for quests associated with the authenticated user.
     *
     * @return HasMany The relationship instance.
     */
    public function Assoc(): HasMany
    {
        return $this->hasMany(UserQuest::class, 'scenario_id', 'id')->where('user_id', auth()->id());
    }


    /* Computed Attributes */

    /**
     * Checks if the authenticated user has any associated quests for this scenario.
     *
     * @return bool True if the user has associated quests, false otherwise.
     */
    public function getUserQuestExistsAttribute(): bool
    {
        $id = Auth::id();
        if($this->Assoc->count()){
            return $this->Assoc->count() > 0;
        }
        
        return false;
    }

    /**
     * Checks if the authenticated user has succeeded in any quests for this scenario.
     *
     * @return bool True if the user has succeeded in a quest, false otherwise.
     */
    public function getUserQuestSucceedAttribute(): bool
    {
        $id = Auth::id();
        if($record = $this->Assoc->where('amount', '>', 0)->where('reputation', 10)->count()){
            return $record > 0;
        }
        
        return false;
    }

    /**
     * Checks if the authenticated user has failed any quests for this scenario.
     *
     * @return bool True if the user has failed a quest, false otherwise.
     */
    public function getUserQuestFailedAttribute(): bool
    {
        $id = Auth::id();
        if($record = $this->Assoc->where('amount', '<', 0)->where('reputation', '<=', 0)->count()){
            return $record->count() > 0;
        }
        
        return false;
    }


    /* Additional Accessors */

    /**
     * Retrieves the maximum number of examinations allowed for the scenario.
     *
     * @return int|null The maximum examination count, or null if not set.
     */
    public function getExaminationMaxAttribute()
    {
        return json_decode($this->attempts)->examination ?? null;
    }

    /**
     * Retrieves the maximum number of investigations allowed for the scenario.
     *
     * @return int|null The maximum investigation count, or null if not set.
     */
    public function getInvestigationMaxAttribute()
    {
        return json_decode($this->attempts)->investigation ?? null;
    }

    /**
     * Retrieves the maximum number of treatments allowed for the scenario.
     *
     * @return int|null The maximum treatment count, or null if not set.
     */
    public function getTreatmentMaxAttribute()
    {
        return json_decode($this->attempts)->treatment ?? null;
    }
}
