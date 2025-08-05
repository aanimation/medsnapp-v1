<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Notification extends Model
{
    protected $table 		= 'notifications';
    protected $guarded  	= ['id'];

    public function Content(): HasMany
    {
        return $this->hasMany(UserNotif::class, 'notification_id', 'id');
    }

}
