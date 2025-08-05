<?php
namespace App\Models;

use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasOne, HasMany};

/**
 * Class UserQuestInv
 *
 * Represents the inventory items associated with a user's quest.
 * This model manages the relationships between users, their quests,
 * and the inventory items used within those quests.
 */
class UserQuestInv extends Model
{
    use SoftDeletes;

    protected $table 		= 'users_quests_invs';
    protected $guarded  	= ['id'];
    public    $timestamps   = true;
    protected $dates        = ['deleted_at'];

    protected $casts = [
        'is_correct' => 'boolean',
    ];

    /**
     * Defines a relationship to the User model.
     *
     * @return BelongsTo The relationship instance representing the user associated with the inventory.
     */
    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Defines a relationship to the Scenario model for the associated quest.
     *
     * @return BelongsTo The relationship instance representing the quest scenario.
     */
    public function Quest(): BelongsTo
    {
        return $this->belongsTo(Scenario::class, 'scenario_id', 'id');
    }

    /**
     * Defines a relationship to the Inventory model.
     *
     * @return BelongsTo The relationship instance representing the inventory item associated with the quest.
     */
    public function Inventory(): BelongsTo
    {
        return $this->belongsTo(Inventory::class, 'inv_id', 'id');
    }

    /**
     * Defines a relationship to the UserQuest model.
     *
     * @return BelongsTo The relationship instance representing the user quest associated with the inventory item.
     */
    public function UserQuest(): BelongsTo
    {
        return $this->belongsTo(UserQuest::class, 'case_id', 'id');
    }
}
