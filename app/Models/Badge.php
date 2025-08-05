<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Badge extends Model
{
    protected $table 		= 'badges';
    protected $guarded  	= ['id'];
    protected $primaryKey   = 'skey';
    public    $incrementing = false;
    public    $appends      = ['userBadgeExists', 'hasClaimed'];

    /**
     * Defines a one-to-many relationship with the UserBadge model.
     *
     * @return HasMany The relationship instance.
     */
    public function Assoc(): HasMany
    {
        return $this->hasMany(UserBadge::class, 'badge_id', 'id')
                    ->where('user_id', auth()->id());
    }

    /**
     * Checks if the user has associated badges.
     *
     * @return bool True if the user has associated badges, false otherwise.
     */
    public function getUserBadgeExistsAttribute(): bool
    {
        $id = auth()->id();
        if ($this->Assoc->count()) {
            return $this->Assoc->count() > 0;
        }

        return false;
    }

    /**
     * Checks if the badge has been claimed by the user.
     *
     * @return bool True if claimed, false otherwise.
     */
    public function getHasClaimedAttribute(): bool
    {
        $id = auth()->id();
        if ($this->Assoc->count()) {
            return $this->Assoc->first()->is_claimed;
        }

        return false;
    }
}
