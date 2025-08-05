<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\{User, UserAtts, UserInfo, UserInv, Badge, Scenario, Inventory, Invite, 
    Question, QuestionSession, QuestionUser,
    Transaction as Trans, UserQuestInv, 
    Subscription, Subscriber,
    DailyCoin, DailyEnergy, DailyReward };

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        DailyCoin::observe(\App\Observers\CoinObserver::class);
        DailyEnergy::observe(\App\Observers\EnergyObserver::class);
        DailyReward::observe(\App\Observers\DailyRewardObserver::class);

        User::observe(\App\Observers\UserObserver::class);
        UserAtts::observe(\App\Observers\UserAttsObserver::class);
        UserInfo::observe(\App\Observers\UserInfoObserver::class);
        Scenario::observe(\App\Observers\QuestionObserver::class);
        Badge::observe(\App\Observers\BadgeObserver::class);
        Inventory::observe(\App\Observers\InventoryObserver::class);
        Invite::observe(\App\Observers\InviteObserver::class);
        Question::observe(\App\Observers\QueObserver::class);
        QuestionSession::observe(\App\Observers\QueSessionObserver::class);
        QuestionUser::observe(\App\Observers\QueUserObserver::class);
        Trans::observe(\App\Observers\TransactionObserver::class);
        UserQuestInv::observe(\App\Observers\UserQuestInvObserver::class);
        UserInv::observe(\App\Observers\UserInvObserver::class);
        Subscription::observe(\App\Observers\SubscriptionObserver::class);
        Subscriber::observe(\App\Observers\SubscriberObserver::class);
    }
}
