<?php

namespace App\Http\Gamification;

use Illuminate\Support\Facades\Log;

use PostHog\PostHog;
use Livewire\Component;
use Livewire\Attributes\Url;
use Carbon\Carbon;

use Stripe\Stripe as StripeModule;
use Stripe\Checkout\Session as StripeCheckout;

use App\Models\{Transaction as Trans, Subscription, Subscriber};
use App\Traits\{WithSwal, WithNotification};

class Offer extends Component
{
    use WithSwal, WithNotification;

    protected $template = 'offer';
    protected $userId;

    public $currentSubscribedId;
    public $items;
    public $message;

    #[Url]
    public $session;
    
    #[Url]
    public $res;

    public function boot()
    {
        $this->userId = auth()->id();
        $this->items = Subscription::whereStatus('active')->get();
        $this->currentSubscribedId = auth()->user()->Subscribe[0]->subscription_id ?? 0;
    }

    public function mount()
    {
        /**
         * Upgrade Plan transaction cancelled
         */
        if($this->session) {
            if($this->res){ // cancelled only
                if($trans = Trans::whereTransType('subscription')
                ->whereTransCode($this->session)
                ->whereStatus('unpaid')
                ->whereUserId($this->userId)
                ->orderBy('id', 'DESC')
                ->first()){
                    $trans->updateQuietly(['status' => 'cancelled', 'cancelled_at' => now()]);
                    $message = "Transaction cancelled";
                    $this->SuccessfullAlert($message, 'Info!');
                }
                else{
                    Log::info('Session '.$this->session.' exists but unpaid transaction not found');
                }
            }
        }
    }

    public function purchaseItem(string $tierCode)
    {
        $baseUrl = config('app.url');
        $currency = config('stripe.currency');
        $secret = config('stripe.secret');

        $tier = Subscription::find($tierCode);

        $itemId = $tier->tier_code;
        $name = $tier->tier_name;
        $description = $tier->tier_desc;
        $subject = 'subscription';
        $size = $tier->size;
        $price = $tier->price;

        $trans = Trans::firstOrCreate([
            'subject' => $subject,
            'trans_type' => $subject,
            'user_id' => $this->userId,
            'quantity' => $size,
            'total_price' => $price * $size,
            'status' => 'unpaid'
        ],[
            'updated_at' => Carbon::now(),
        ]);

        $trans->fresh();

        StripeModule::setApiKey($secret);
        $session = StripeCheckout::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => $currency,
                        'product_data' => [
                            'name' => $name,
                            'description' => $description,
                        ],
                        'unit_amount' => $price * 100, // convert to Cent
                    ],
                    'quantity' => $size
                ],
            ],
            // 'discounts' => [['coupon' => 'eGpIZve2']], // cant double with promo
            'allow_promotion_codes' => true,
            'mode' => 'payment',
            'success_url' => $baseUrl.'/player/profile/bills?session='.$trans->trans_code,
            'cancel_url' => $baseUrl.'/offer/subscription?session='.$trans->trans_code.'&res=cancel',
            'payment_method_types' => ['card'],//,'paypal'],
            [
                'metadata' => [
                    'subject'   => $subject,
                    'size'      => $size,
                    'item_id'   => $itemId,
                    'purchase_id' => $trans->trans_code,
                ]
            ]
        ]);

        /**
         * Add subscribe
         * Rest of free days will added as bonus days
         * Rest of previous paid tier will added as ext days
         */
        $user = auth()->user();
        $freeDaysLeft = $user->free_tier_left_days;
        if($freeDaysLeft == 0 && $user->hasSubscribed) {
            $freeDaysLeft = $user->subscribed_tier_left_days;
        }

        Subscriber::updateOrCreate([
            'subscription_id' => $tier->id,
            'user_id' => $this->userId,
            'status' => 'pending',
        ],[
            'trans_id' => Trans::whereTransCode($trans->trans_code)->first()->id,
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addMonths($size)->addDays($freeDaysLeft),
            'updated_at' => Carbon::now()
        ]);

        $trans->updateQuietly(['payment_note' => $session->id]);

        if(App()->isProduction()) {
            PostHog::capture([
                'distinctId' => auth()->user()->username,
                'event' => '$set',
                'properties' => [
                    '$set' => ['name' => auth()->user()->name, 'email' => auth()->user()->email],
                    '$set_once' => ['initial_url' => url()->current()],
                ]
            ]);
        }

        // set notification
        $this->addUpgradeNotification(auth()->id());

        return redirect()->away($session->url);
    }

    public function render()
    {
        return view('gamification.'.$this->template);
    }

}
