<?php

namespace App\Http\Gamification\Shop;

use PostHog\PostHog;
use Livewire\Component;
use PlutoLinks\Loops\Laravel\Facades\Loops;

use Stripe\Stripe as StripeModule;
use Stripe\Checkout\Session as StripeCheckout;

use App\Traits\{WithPlayerAtts, WithPlayerInvents};
use App\Models\{Inventory, Transaction as Trans};

class Purchase extends Component
{
    use WithPlayerAtts, WithPlayerInvents;

    protected $template = 'purchase';

    public $item;
    public $message;

    protected $listeners = ['setPurchaseItem'];

    public function setPurchaseItem(string $key)
    {
        $this->reset('item', 'message');
        $this->item = Inventory::find($key);
        $this->dispatch('purchaseEvent', show:true);

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
    }

    public function purchaseItem(string $key)
    {
        $baseUrl = config('app.url');
        $item = $this->item;
        $user = auth()->user();

        $currency = config('stripe.currency');
        $secret = config('stripe.secret');

        $itemId = $item->id;
        $productName = $item->name;
        $subject = str_contains($item->icon, 'coin') ? 'coins' : 'health';
        $size = $item->damage;
        $price = $item->price_dec ?? $item->price;

        $trans = Trans::updateOrCreate([
            'trans_type' => 'currency',
            'user_id' => $user->id,
            'subject' => $subject,
            'quantity' => $size,
            'total_price' => $price,
            'status' => 'unpaid',
        ],[
            'updated_at' => now(),
        ]);

        $trans->fresh();

        StripeModule::setApiKey($secret);
        $session = StripeCheckout::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => $currency,
                        'product_data' => [
                            'name' => $productName,
                        ],
                        'unit_amount' => $price * 100, // Dollar to Cent
                    ],
                    'quantity' => 1
                ],
            ],
            'mode' => 'payment',
            'success_url' => $baseUrl.'/player/shop?session='.$trans->trans_code,
            'cancel_url' => $baseUrl.'/player/shop?session='.$trans->trans_code.'&res=cancel',
            'payment_method_types' => ['card'],//,'paypal'],
            [
                'metadata' => [
                    'subject'     => $subject,
                    'size'        => $size,
                    'item_id'     => $itemId,
                    'purchase_id' => $trans->trans_code,
                ]
            ]
        ]);

        $trans->updateQuietly(['payment_note' => $session->id]);

        // close purchase modal
        $this->dispatch('purchaseEvent', show:false);

        if(App()->isProduction()) {
            // send email notification
            $transactionId = config('loops.transactional.currency');
            $name = $user->lastname ?? $user->firstname ?? 'MedSnapp Member';
            $dataVariables = [
                'name'        => $name,
                'productName' => $productName,
            ];
            // Loops::transactional()->send($transactionId, $user->email, $dataVariables);
        }

        return redirect()->away($session->url);
    }

    public function render()
    {
        return view('gamification.shop.'.$this->template);
    }

}
