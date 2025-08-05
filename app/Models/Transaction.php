<?php
namespace App\Models;

use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class Transaction extends Model
{
    use SoftDeletes;

    protected $table 		= 'transactions';
    protected $guarded      = ['id'];
    protected $primaryKey   = 'skey';
    public    $incrementing = false;
    public    $timestamps   = true;
    protected $dates        = ['deleted_at'];

    protected $casts = [
        'payment_note' => 'array',
    ];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Retrieves the discount amount from the payment note.
     *
     * @return float|null The discount amount (in dollars), or null if not applicable.
     * 
     * This method checks if the payment_note is present and is an array, and that
     * the payment status is 'paid'. It then extracts the amount discount from the 
     * total details and converts it from cents to dollars.
     */
    public function getDiscountAttribute()
    {
        if($this->payment_note && !is_string($this->payment_note) && $this->payment_status == 'paid'){
            $note = $this->payment_note;
            if(isset($note['total_details']['amount_discount'])) {
                return $note['total_details']['amount_discount']/100; // revert from Cent
            }
        }

        return null;
    }
}
