<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Carbon\Carbon;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class User extends Authenticatable implements FilamentUser
{
    use Notifiable, SoftDeletes;

    protected $guarded = ['id'];

    /**
     * @var array The attributes that should be hidden for arrays.
     * This includes sensitive information such as password and timestamps.
     */
    protected $hidden = [
        'password',
        'remember_token',
        'login_at',
        'logout_at',
        'signin_times',
        'signout_times',
        'deleted_at',
        'updated_at',
    ];

    /**
     * @var array The attributes that should be cast to native types.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
        'is_lock' => 'boolean',
        'is_new' => 'boolean',
    ];

    /**
     * @var array The attributes that should be appended to the model's array form.
     */
    public $appends = ['last_login', 'free_tier_left_days', 'subscribed_tier_left_days', 'max_days', 'today_streak', 'yesterday_streak'];

    /**
     * Defines a relationship to the UserInfo model.
     *
     * @return BelongsTo The relationship instance.
     */
    public function Info(): BelongsTo
    {
        return $this->belongsTo(UserInfo::class, 'id', 'user_id');
    }

    /**
     * Defines a relationship to the UserAtts model.
     *
     * @return BelongsTo The relationship instance.
     */
    public function Atts(): BelongsTo
    {
        return $this->belongsTo(UserAtts::class, 'id', 'user_id');
    }

    /**
     * Defines a relationship to the Role model.
     *
     * @return BelongsTo The relationship instance.
     */
    public function Role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Defines a relationship to the UserNotif model.
     *
     * @return HasMany The relationship instance.
     */
    public function Notification(): HasMany
    {
        return $this->hasMany(UserNotif::class)->orderBy('id', 'DESC');
    }

    /**
     * Defines a relationship to the Subscriber model for active subscriptions.
     *
     * @return HasMany The relationship instance.
     */
    public function Subscribe(): HasMany
    {
        return $this->hasMany(Subscriber::class)->whereStatus('active')->orderBy('id', 'DESC');
    }

    /**
     * Defines a relationship to the UserQuest model for active quests.
     *
     * @return HasMany The relationship instance.
     */
    public function ActiveQuest(): HasMany
    {
        return $this->hasMany(UserQuest::class)->orderBy('id', 'DESC');
    }

    /**
     * Streak
     */

    /**
     * Defines a relationship to the Streak model.
     * 
     * This relationship limits the results to the two most recent streaks (today and yesterday).
     *
     * @return HasMany The relationship instance.
     */
    protected function Streak(): HasMany
    {
        // limit 2 perhaps today and yesterday
        return $this->hasMany(Streak::class)->orderBy('created_at', 'DESC')->limit(2);
    }

    /**
     * Checks if the user has a streak for today.
     *
     * @return bool True if the user has a streak for today, false otherwise.
     */
    protected function getTodayStreakAttribute(): bool
    {
        if($this->Streak->count() == 0){
            return false;
        }

        return $this->Streak->where('day_date', Carbon::now()->toDateString())->count() > 0;
    }

    /**
     * Checks if the user has a streak for yesterday.
     *
     * @return bool True if the user has a streak for yesterday, false otherwise.
     */
    protected function getYesterdayStreakAttribute(): bool
    {
        if($this->Streak->count() == 0){
            return false;
        }

        return $this->Streak->where('day_date', Carbon::yesterday()->toDateString())->count() > 0;
    }

    /**
     * Booster
     */

    /**
     * Defines a relationship to the DailyCoin model for coin boosts.
     *
     * @return HasMany The relationship instance.
     */
    public function CoinBoost(): HasMany
    {
        return $this->hasMany(DailyCoin::class);
    }

    /**
     * Defines a relationship to the DailyEnergy model for energy boosts.
     *
     * @return HasMany The relationship instance.
     */
    public function EnergyBoost(): HasMany
    {
        return $this->hasMany(DailyEnergy::class);
    }

    // DEPRECATED
    /*protected function getTodayEnergyBoostAttribute(): bool
    {
        return $this->EnergyBoost->where('day_date', Carbon::now()->toDateString())->count() == 0;
    }*/

    // DEPRECATED
    /*protected function getTodayCoinBoostAttribute(): bool
    {
        return $this->CoinBoost->where('day_date', Carbon::now()->toDateString())->count() == 0;
    }*/


    /**
     * user Tier and Subscribe
     */

    /**
     * Calculates the number of days left for the user's current tier.
     *
     * @return int The number of days left in the current tier.
     */
    protected function getLeftDaysAttribute(): int
    {
        if(!$this->has_subscribed) {
            return $this->free_tier_left_days;
        }

        return $this->subscribed_tier_left_days;
    }

    /**
     * Calculates the maximum days for the user's subscription.
     *
     * @return int The maximum number of days left for the subscription.
     */
    protected function getMaxDaysAttribute(): int
    {
        if(!$this->has_subscribed) {
            return 14;
        }

        $subscribe = $this->Subscribe->first();

        return Carbon::parse($subscribe->start_date)->diffInDays($subscribe->end_date);
    }

    /**
     * Calculates the number of days left for the free tier.
     *
     * @return int The number of days left in the free tier.
     */
    protected function getFreeTierLeftDaysAttribute(): int
    {
        $created = new Carbon($this->created_at);
        $now = Carbon::now();
        $difference = $created->diffInDays($now);
        $freeDay = 15 - intval($difference);
        return $freeDay > 0 ? $freeDay : 0;
    }

    /**
     * Checks if the user has an active subscription.
     *
     * @return bool True if the user is subscribed, false otherwise.
     */
    protected function getHasSubscribedAttribute(): bool
    {
        return $this->Subscribe
        ->where('status', 'active')
        ->whereNotNull('trans_id')
        ->where('end_date', '>=', Carbon::now())
        ->count() > 0;
    }

    /**
     * Checks if the user's subscription has expired.
     *
     * @return bool True if the subscription has expired, false otherwise.
     */
    protected function getHasExpiredAttribute(): bool
    {
        return $this->Subscribe
        ->where('status', 'active')
        ->whereNotNull('trans_id')
        ->where('end_date', '<=', Carbon::now())
        ->count() > 0;
    }

    /**
     * Calculates the number of days left for the subscribed tier.
     *
     * @return int The number of days left in the subscribed tier.
     */
    protected function getSubscribedTierLeftDaysAttribute(): int
    {
        if(!$this->has_subscribed) {
            return 0;
        }

        $subscribe = $this->Subscribe
        ->where('status', 'active')
        ->whereNotNull('trans_id')
        ->where('end_date', '>=', Carbon::now())
        ->first();
        
        $end = new Carbon($subscribe->end_date);
        $now = Carbon::now();
        $days = $now->diffInDays($end) + 1;
        return $days > 0 ? $days : 0;
    }

    /**
     * Retrieves the first name of the user.
     *
     * @return string The user's first name.
     */
    protected function getFirstnameAttribute(): string
    {
        return $this->Info->firstname;
    }

    /**
     * Retrieves the last name of the user.
     *
     * @return string The user's last name.
     */
    protected function getLastnameAttribute(): string
    {
        return $this->Info->lastname;
    }

    /**
     * Retrieves the specialty of the user.
     *
     * @return string The user's specialty or 'no-specialty' if not set.
     */
    protected function getSpecialityAttribute(): string
    {
        return $this->Info->speciality ?? 'no-specialty';
    }

    /**
     * Retrieves the current health of the user.
     *
     * @return int The user's current health.
     */
    protected function getCurrentHealthAttribute(): int
    {
        return $this->Atts->health ?? 0;
    }

    /**
     * Retrieves the maximum health of the user.
     *
     * @return int The user's maximum health.
     */
    protected function getMaxHealthAttribute(): int
    {
        return $this->Atts->max_health ?? 100;
    }

    /**
     * Retrieves the current points of the user.
     *
     * @return int The user's current points.
     */
    protected function getCurrentPointsAttribute(): int
    {
        return $this->Atts->points ?? 0;
    }

    /**
     * Retrieves the maximum points of the user.
     *
     * @return int The user's maximum points.
     */
    protected function getMaxPointsAttribute(): int
    {
        return $this->Atts->max_points ?? 100;
    }

    /**
     * Retrieves the current coins of the user.
     *
     * @return int The user's current coins.
     */
    protected function getCurrentCoinsAttribute(): int
    {
        return $this->Atts->coins ?? 0;
    }

    /**
     * Retrieves the maximum coins of the user.
     *
     * @return int The user's maximum coins.
     */
    protected function getMaxCoinsAttribute(): int
    {
        return $this->Atts->max_coins ?? 100;
    }

    /**
     * Retrieves the current experience points of the user.
     *
     * @return int The user's current experience points.
     */
    protected function getCurrentExpsAttribute(): int
    {
        return $this->Atts->exps ?? 0;
    }

    /**
     * Retrieves the maximum experience points of the user.
     *
     * @return int The user's maximum experience points.
     */
    protected function getMaxExpsAttribute(): int
    {
        return $this->Atts->max_exps ?? 100;
    }

    /**
     * Checks if the user has any active quests.
     *
     * @return bool True if the user has active quests, false otherwise.
     * 
     * 
     * sample : $this->player->hasActiveQuest
     */
    protected function getHasActiveQuestAttribute(): bool
    {
        return $this->ActiveQuest()->where('reputation', null)->count() > 0;
    }

    /**
     * Retrieves a human-readable representation of the last login time.
     *
     * @return string The formatted last login time.
     */
    protected function getLastLoginAttribute(): string
    {
        $date = $this->login_at ?? $this->created_at;
        return Carbon::parse($date)->diffForHumans();
    }

    /**
     * Checks if the user is an admin based on their email and role ID.
     *
     * @return bool True if the user is an admin, false otherwise.
     */
    protected function getIsAdminAttribute(): bool
    {
        return str_starts_with($this->email, 'admin') && $this->role_id == 1;
    }

    /**
     * Checks if the user is an operator based on their role ID.
     *
     * @return bool True if the user is an operator, false otherwise.
     */
    protected function getIsOperatorAttribute(): bool
    {
        // return str_ends_with($this->email, 'medsnapp.op') && $this->role_id == 2;
        return $this->role_id == 2;
    }

    /**
     * Filament user
     * admin@medsnapp.com
     * admin@staging.medsnapp.com
     * 
     * 
     * Determines if the user can access the Filament panel based on their email and verification status.
     *
     * @param Panel $panel The panel to check access for.
     * @return bool True if the user can access the panel, false otherwise.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return str_starts_with($this->email, 'admin') && str_ends_with($this->email, 'medsnapp.com') && $this->hasVerifiedEmail();
    }
}
