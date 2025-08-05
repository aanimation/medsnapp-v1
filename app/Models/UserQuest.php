<?php
namespace App\Models;

use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

/**
 * Class UserQuest
 *
 * Represents a quest associated with a user in the application.
 * This model manages the relationships between users and their quests,
 * including quest usage and inventory.
 */
class UserQuest extends Model
{
    use SoftDeletes;
    
    protected $table 		= 'users_quests';
    protected $guarded  	= ['id'];
    public    $timestamps   = true;
    protected $dates        = ['deleted_at'];

    /**
     * Defines a relationship to the User model.
     *
     * @return BelongsTo The relationship instance representing the user associated with the quest.
     */
    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Defines a relationship to the Scenario model for the quest.
     *
     * @return BelongsTo The relationship instance representing the quest scenario.
     */
    public function Quest(): BelongsTo
    {
        return $this->belongsTo(Scenario::class, 'scenario_id', 'id');
    }

    /**
     * Defines a relationship to the Scenario model for the quest.
     *
     * Note: This method appears to be duplicated. Consider removing one of the
     * similar methods to avoid confusion.
     *
     * @return BelongsTo The relationship instance representing the quest scenario.
     */
    public function Scenario(): BelongsTo // Duplicated
    {
        return $this->belongsTo(Scenario::class);
    }

    /**
     * Defines a relationship to the UserQuestInv model for usage inventory.
     *
     * @return HasMany The relationship instance representing the quest inventory usage.
     */
    public function UsageInv(): HasMany
    {
        return $this->hasMany(UserQuestInv::class, 'case_id', 'id');
    }
}
