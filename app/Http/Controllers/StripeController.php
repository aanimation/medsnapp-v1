<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Log};

use PostHog\PostHog;
use PlutoLinks\Loops\Laravel\Facades\Loops;

use App\Traits\WithNotification as NotifTrait;
use App\Models\{User, UserInv, Transaction as Trans};

class StripeController extends Controller
{
    use NotifTrait;

    public function stripeWebhook(Request $request)
    {
        //Log::info(['request' => $request->all(), 'location' => 'webhook incoming']);

        if($request->type == 'checkout.session.expired') {
            return response('expired', 200);
        }

        $result = $this->_stripeWebhook($request);

        if(!$result['status']){
            return response($result, 200);
        }

        $this->_proceed($result);

        return response('Transaction was success '.$result['property'], 200);
    }

    function _stripeWebhook($resp)
    {
        // $typeResult = $resp->type;

        $session = $resp->data['object'];
        $sessionId = $session['id'];

        Log::info(['message' => 'log of _stripeWebhook StripeController.php', 'session' => $session, 'sessionId' => $sessionId]);

        if(empty($session['metadata']['subject'])){
            return ['status' => false, 'message' => 'no subject key'];
        }

        // $email = $session['customer_details']['email'];
        // $name = $session['customer_details']['name'];
        $subject = $session['metadata']['subject']; //coins|health|subscription
        $size = (int)$session['metadata']['size'];
        $itemId = $session['metadata']['item_id'];
        $purchaseId = $session['metadata']['purchase_id'];
        $status = $session['payment_status'];

        if($trans = Trans::whereTransCode($purchaseId)->whereQuantity($size)->first()){

            $trans->updateQuietly([
                'payment_status'    => $status,
                'status'            => $status,
                'payment_type'      => $session['payment_method_types'][0],
                'payment_amount'    => $session['amount_total']/100,
                'payment_datetime'  => now(),
                'paid_at'           => now(),
                'payment_note'      => $session,
            ]);

            if(App()->isProduction()) {
                PostHog::capture([
                    'distinctId' => $trans->user_id,
                    'event'      => 'stripe webhook received'
                ]);

                if($status === 'paid'){
                    // send email notification
                    /*
                    $transactionId = config('loops.transactional.payment-succeded');
                    $dataVariables = [
                        'currencyName'  => ucfirst($subject),
                        'currencySize'  => $size,
                        'purchaseCode'  => $trans->trans_code,
                        'profileLink'   => route('player-bills'),
                    ];
                    
                    Loops::transactional()->send($transactionId, $email, $dataVariables);
                    */

                    // set in-app notification
                    $this->addPaymentNotification($trans->user_id, $trans->trans_code);
                }
            }

            return ['status' => true, 'user_id'=> $trans->user_id, 'size' => $size, 'property' => $subject, 'item_id' => $itemId, 'message' => $status];
        }else{
            $msg = 'No query trans_code:'.$purchaseId.' size:'.$size;
            Log::info(['message' => $msg, 'sessionId' => $sessionId]);
            return ['status' => false, 'message' => $msg];
        }
    }

    function _proceed($result)
    {
        if($result['property'] === 'subscription'){
            return;
        }

        $user = User::find($result['user_id']);
        $property = $result['property'];
        $size = $result['size'];

        if($property === 'coins'){
            $propMaxValue = $user->Atts["max_{$property}"];
            $user->Atts->update(["max_{$property}" => $propMaxValue+(100*$user->level)]);
        }

        $user->Atts->increment($property, $size);

        UserInv::updateOrCreate([
            'user_id' => $user->id,
            'inv_id' => $result['item_id'],
        ],[
            'amount' => DB::raw('users_inventories.amount + '.$size)
        ]);

        return;
    }

}
