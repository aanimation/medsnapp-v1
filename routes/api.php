<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Config, Route};

use App\Http\Controllers\StripeController as Stripe;
use App\Http\Controllers\PlayerController as Player;

if(Config::get('app.env') === 'production') {
    $domainMain = 'main';
    $domainApp = 'platform';
}elseif(Config::get('app.env') === 'staging') {
    $domainMain = 'staging';
    $domainApp = 'staging';
}else{
    $domainMain = '';
    $domainApp = '';
}

Route::group(['domain' => Config::get('sites.urls.'.$domainMain)], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');

    /*Stripe Webhook*/
    Route::post('ext/stripe-webhook', [Stripe::class, 'stripeWebhook']);

    /*Firebase token*/
    Route::post('int/send-token', [Player::class, 'sendToken']);
});
