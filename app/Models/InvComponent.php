<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{HasMany, HasOne};

class InvComponent extends Model
{
    protected $table        = 'inv_components';
    protected $guarded      = ['id'];
    protected $hidden       = ['id', 'inv_id'];
    // protected $appends      = ['patient_val', 'pasca_val'];

    /**
     * Defines a one-to-one relationship with the InvQuestValue model.
     *
     * @return HasOne The relationship instance.
     */
    public function ComValue(): HasOne
    {
        return $this->hasOne(InvQuestValue::class, 'com_id', 'id');
    }

    /**
     * Retrieves the patient value associated with the component.
     *
     * @return mixed|null The patient value if available, null otherwise.
     */
    public function getPatientValAttribute()
    {
        if ($this->ComValue) {
            return $this->ComValue->patient;
        }

        return null;
    }

    /**
     * Retrieves the post-care (pasca) value associated with the component.
     *
     * @return mixed|null The pasca value if available, null otherwise.
     */
    public function getPascaValAttribute()
    {
        if ($this->ComValue) {
            return $this->ComValue->pasca;
        }

        return null;
    }
}
