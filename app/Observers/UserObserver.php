<?php

namespace App\Observers;

use App\Http\Gamification\Admin\Question;
use Illuminate\Support\Facades\{DB, Http, Log, Mail};
use Illuminate\Support\Str;
use Exception;
use Carbon\Carbon;

use Jenssegers\Agent\Agent as JAgent;
use PlutoLinks\Loops\Laravel\Facades\Loops;

use App\Mail\PlayerRegister;
use App\Models\{Badge, User, UserAtts, UserBadge, Role, HeatmapStat, Invite, LoginAttempt, QuestionSession};

class UserObserver
{
    public function creating(User $item): void
    {
        $item->skey = Str::Uuid()->toString();
        $item->ref_code = $this->_generateCode();

        if(is_null($item->google_id)){
            $item->verify_code = Str::random(20);
        }

        if(is_null($item->email_verified_at)){
            $item->role_id = Role::whereRoleName('Player')->first()->id;
        }
    }

    public function created(User $item): void
    {
        $siteUrl = config('sites.urls.' . $this->_getDomain());
        $activateLink = "{$siteUrl}/verify/player/{$item->verify_code}/new";

        if(App()->isProduction()) {
            // BeeHive Auto Create Subscription
            $beehiivConfigs = config('services.beehiiv');
            $url = "{$beehiivConfigs['url']}/{$beehiivConfigs['api_v2']['publication_id']}/subscriptions";
            $token = $beehiivConfigs['api_key'];
            try {
                $response = Http::withToken($token)->post($url,
                    ['email' => $item->email]
                );
                // Log::info(['target' => 'beehiiv', 'user_id' => $item->id, 'message' => $response->body()]);  
            } catch(Exception $e) {
                Log::info(['message' => $e->getMessage(), 'loc' => 'beehiv']);
            }

            if($makeWebhookUrl = config('services.make.webhook_url')) {
                Http::post($makeWebhookUrl,
                    ['email' => $item->email]
                );
            }
        }


        // Send email register notification at first
        if(is_null($item->email_verified_at)){
            if(App()->isProduction()) {
                // send email notification
                $transactionId = config('loops.transactional.new');
                $dataVariables = [
                    'link' => $activateLink,
                ];
                Loops::transactional()->send($transactionId, $item->email, $dataVariables);
            }else{
                Mail::to($item->email)->send(new PlayerRegister($item->email, $item->name, $activateLink));
            }
        }

        // Detect an Invitation from email registered
        if($invite = Invite::whereEmail($item->email)->first()) {
            $rewards = [1=>5,10,15,20,25,30,35,40,45,50];

            // Get referrer count
            $refCount = Invite::whereUserId($invite->user_id)->whereStatus('accepted')->count();
            
            $coins = $rewards[$refCount +1]; // +1 just add an increment
            $invite->updateQuietly([
                'status' => 'accepted',
                'coins' => $coins,
                'player_id' => $item->id
            ]);

            // give the invitation gifted coins
            $referrer = UserAtts::whereUserId($invite->user_id)->first();
            $referrer->updateQuietly([
                'coins' => DB::raw('users_atts.coins +'. $coins)
            ]);
        }

        // Detect Referral Code in session
        if (session()->has('medsnapp_referral')) {
            $referralCode = session()->get('medsnapp_referral');

            if($owner = User::whereRefCode($referralCode)->first()) {
                $owner->updateQuietly(['ref_count' => $owner->ref_count + 1]);

                $item->updateQuietly(['ref_by' => $owner->id]);

                Invite::create([
                    'user_id'   => $owner->id,
                    'from'      => 'referral',
                    'email'     => $item->email,
                    'status'    => 'pending',
                    'player_id' => $item->id,
                    'response'  => $referralCode
                ]);
            }
        }
    }

    public function updated(User $item): void
    {
        $now = Carbon::now();

        if($item->wasChanged('email_verified_at')){
            $giftCoins = 100;
            if($invite = Invite::where('from', 'referral')->whereEmail($item->email)->whereStatus('pending')->first()) {
                $invite->updateQuietly(['status' => 'accepted', 'coins' => $giftCoins]);

                // give the referral gifted coins 100
                $referrer = UserAtts::whereUserId($invite->user_id)->first();
                $referrer->updateQuietly([
                    'coins' => DB::raw('users_atts.coins + '.$giftCoins)
                ]);
            }
        }

        if($item->wasChanged('level')){ // level changed by exps
            if($badge = Badge::where(['category' => 'level', 'requirement' => $item->level])->first()) {
                UserBadge::updateOrCreate([
                    'badge_id' => $badge->id,
                    'user_id' => $item->id,
                ],[
                    'track_his' => 'user observer',
                ]);
            }
        }

        if($item->wasChanged('signin_times')){
            // Login logs
            $ag = new JAgent();
            LoginAttempt::create([
                'user_id' => $item->id,
                'email' => $item->email,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'success' => true,
                'extras' => [
                    'robot' => $ag->robot(),
                    'lang' => $ag->languages(),
                    'device' => $ag->device(),
                    'platform' => $ag->platform(),
                    'browser' => $ag->browser(),
                    'isMobile' => $ag->isMobile(),
                    'isTablet' => $ag->isTablet(),
                    'isDesktop' => $ag->isDesktop(),
                    'isPhone' => $ag->isPhone(),
                    'google' => true
                ],
            ]);

            HeatmapStat::updateOrCreate([
                'user_id' => $item->id,
                'day_week' => $now->dayOfWeek, 
                'week' => $now->weekOfYear,
            ],[
                'activity' => DB::raw('heatmap_stats.activity + 1'),
                'other' => DB::raw('heatmap_stats.other + 1') 
            ]);
        }

        if($item->wasChanged('signout_times')){
            if(App()->isProduction()) {
                \PostHog\PostHog::capture([
                    'distinctId' => $item->username ?? 'guest',
                    'event' => '$set',
                    'properties' => [
                        '$set' => ['name' => $item->name, 'email' => $item->email],
                        '$set_once' => ['initial_url' => url()->current()],
                    ]
                ]);
            }

            /* Question Session will be reset on every logout */
            if($unfinished = QuestionSession::whereUserId($item->id) 
            ->whereNull('finished_at')
            ->orderBy('id', 'desc')
            ->first()){
                $unfinished->updateQuietly(['finished_at' => now()]); 
            }
        }

        /*
        if($item->wasChanged('rank')){
            //TODO : how to determine rank changed as string
        }
        */
    }

    function _checkAndRegenerate(string $code): string
    {
        if (User::whereRefCode($code)->exists()) {
            return $this->_checkAndRegenerate($this->_generateCode());
        }

        return $code;
    }

    function _generateCode(): string
    {
        $code = '';
        $codeLength = 10;

        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

        $code = substr(str_shuffle(str_repeat($chars, 5)), 0, $codeLength);

        return $this->_checkAndRegenerate($code);
    }

    function _getDomain(): string
    {
        if('production' === config('app.env')) {
            return 'platform';
        }

        if('staging' === config('app.env')) {
            return 'staging';
        }
        
        return 'development';
    }
}
