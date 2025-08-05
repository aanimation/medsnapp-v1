<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscriber extends Model
{
    protected $table        = 'subscribers';
    protected $guarded      = ['id'];
    public    $timestamps   = true;
    protected $dates        = ['deleted_at'];

    /**
     * Defines a relationship to the Subscription model.
     *
     * @return BelongsTo The relationship instance.
     */
    public function Subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class, 'subscription_id', 'id');
    }

    /**
     * Retrieves the name of the current subscription tier.
     *
     * @return string The name of the subscription tier, or 'No Subscription' if none exists.
     */
    public function getCurrentTierAttribute()
    {
        return $this->Subscription->tier_name ?? 'No Subscription';
    }

    /**
     * Defines a relationship to the User model.
     *
     * @return BelongsTo The relationship instance.
     */
    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * NOTE : Admin has ability to set a subscription into user
     * 
     * at this case,
     * trans_id is 0, it is meaning that subscribe set manually
     * 
     * 
     * 
     * Defines a relationship to the Transaction model.
     * 
     * Note: Admins have the ability to set a subscription for a user manually.
     * In this case, if 'trans_id' is 0, it means the subscription was set manually.
     *
     * @return BelongsTo The relationship instance.
     */
    public function Transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'trans_id', 'id');
    }
}
