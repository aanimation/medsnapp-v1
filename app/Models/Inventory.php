<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Builder, Collection, SoftDeletes, Model};
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

/**
 * Class Inventory
 *
 * Represents the "inventories" table in the database.
 * This model includes inventory-related operations, relationships, and attributes.
 */
class Inventory extends Model
{
    use SoftDeletes;
    
    protected $table        = 'inventories';
    protected $guarded      = ['id'];
    protected $primaryKey   = 'skey';
    public    $incrementing = false;
    public    $timestamps   = true;
    protected $dates        = ['deleted_at'];
    public    $appends      = ['user_inv_amount', 'user_inv_exists', 'has_sibling'];
    public    $hidden       = ['id'];

    protected $casts = [
        'specifications' => 'array',
    ];

    /**
     * Defines a one-to-many relationship with the InvComponent model.
     *
     * @return HasMany The relationship instance.
     */
    public function Components(): HasMany
    {
        return $this->hasMany(InvComponent::class, 'inv_id', 'id');
    }

    /**
     * Defines a one-to-many relationship with the UserInv model for user inventories.
     *
     * @return HasMany The relationship instance.
     */
    public function Assoc(): HasMany
    {
        return $this->hasMany(UserInv::class, 'inv_id', 'id')->where('user_id', auth()->id());
    }

    /**
     * Usage of User Inventories
     */
    public function Usage(): HasMany
    {
        return $this->hasMany(UserQuestInv::class, 'inv_id', 'id')->where('user_id', auth()->id());
    }
    
    public function Value(): HasMany
    {
        return $this->hasMany(InvQuestValue::class, 'inv_id', 'id');
    }

    public function Siblings(): HasMany
    {
        return $this->hasMany(Inventory::class, 'name', 'name')->where('is_sibling', true);
    }

    /**
     * Checks if the inventory has sibling components.
     *
     * @return bool True if siblings exist, false otherwise.
     */
    public function getHasSiblingAttribute()
    {
        if(!$this->is_sibling){
            return $this->Siblings->count() > 0;
        }else{
            return false;
        }
    }

    public function getSpecsAttribute()
    {
        return json_decode($this->spesifications);
    }

    public function scopeForShop(Builder $query): Collection
    {
        return $query->where('type', '<>', 'examination')->orderBy('type')->get();
    }

    public function scopeForShopQuery(Builder $query): Builder
    {
        return $query->where('type', '<>', 'examination')->orderBy('type');
    }

    /**
     * Retrieves the user's inventory amount.
     *
     * @return mixed The inventory amount for the authenticated user.
     */
    public function getUserInvAmountAttribute(): int
    {
        $id = Auth::id();
        if($this->Assoc->where('user_id', $id)->count()){
            return $this->Assoc->where('user_id', $id)->first()->amount;
        }
        
        return 0;
    }

    /**
     * DEPRECATED OR DUPLICATED with user_inv_amount ?
     * 
     * Checks if the inventory exists for the user.
     *
     * @return bool True if it exists, false otherwise.
     */
    public function getUserInvExistsAttribute(): bool
    {
        $id = Auth::id();
        if($this->Assoc->where('user_id', $id)->count()){
            return $this->Assoc->where('user_id', $id)->first()->amount >= 0;
        }
        
        return false;
    }

    /**
     * Already use by quest status
     */
    public function getUserInvUsedAttribute($caseId): bool
    {
        $id = Auth::id();
        if($this->Usage->where('user_id', $id)->count()){
            return $this->Usage->where('user_id', $id)->first()->amount >= 0;
        }
        
        return false;
    }


}
