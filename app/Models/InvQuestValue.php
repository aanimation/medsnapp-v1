<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvQuestValue extends Model
{
    protected $table 		= 'invs_quests';
    protected $guarded  	= ['id'];
    protected $appends      = ['inv_name'];

    protected $casts = [
        'specifications' => 'array',
        'alternates' => 'array',
    ];

    /**
     * Defines a relationship to the Inventory model.
     *
     * @return BelongsTo The relationship instance.
     */
    public function Inventory(): BelongsTo
    {
        return $this->belongsTo(Inventory::class, 'inv_id', 'id');
    }

    /**
     * Defines a relationship to the Scenario model.
     *
     * @return BelongsTo The relationship instance.
     */
    public function Scenario(): BelongsTo
    {
        return $this->belongsTo(Scenario::class, 'scenario_id', 'id');
    }

    /**
     * Defines a relationship to the Inventory model for dependency tracking.
     *
     * @return BelongsTo The relationship instance.
     */
    public function DependBy(): BelongsTo
    {
        return $this->belongsTo(Inventory::class, 'depend_by', 'id');
    }

    /**
     * Retrieves the name of the associated inventory.
     *
     * @return mixed The name of the inventory if it exists, null otherwise.
     */
    public function getInvNameAttribute()
    {
        return $this->Inventory->name ?? null;
    }
}
