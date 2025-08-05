<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserNotif extends Model
{
    protected $table 		= 'users_notifications';
    protected $guarded  	= ['id'];
    public    $appends      = ['title', 'description', 'type', 'target_url'];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function Notification(): BelongsTo
    {
        return $this->belongsTo(Notification::class, 'notification_id', 'id');
    }

    public function getTitleAttribute()
    {
        return $this->Notification->title;
    }

    public function getDescriptionAttribute()
    {
        return $this->Notification->description;
    }

    public function getTypeAttribute()
    {
        return $this->Notification->type;
    }

    public function getTargetUrlAttribute()
    {
        return $this->Notification->route ? route($this->Notification->route) : $this->Notification->url;
    }
}
