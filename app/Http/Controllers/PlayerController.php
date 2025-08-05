<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

use PostHog\PostHog;

use App\Models\{User, Invite};

class PlayerController extends Controller
{
    /**
     * store web token from firebase
     */
    public function sendToken(Request $request)
    {
        try{
            $user = User::find($request->user_id);
        }catch(Exception $e) {
            Log::error(['message' => $e->getMessage(), 'request' => $request->all()]);
            return response($e->getMessage(), 410);
        }

        if($request->filled('web_token') && App()->isProduction() && is_null($user->web_token)) {

            $user->updateQuietly(['web_token' => $request->web_token]);
            Log::info(['message' => 'Web token updated', 'user_id' => $user->id, /*'token' => $request->web_token*/]);
        }

        return response('Token subscribed', 200);
    }

    /**
     * Display a listing of the resource.
     */
    public function invitePlayer(Request $request, string $code)
    {
        try{
            $invited = Invite::find($code);
        }catch(Exception $e) {
            return redirect()->route('register')->with('status', 'Invitation code not found');
        }

        $invited->updateQuietly([
            'response' => $request->header('User-Agent'),
        ]);

        if(App()->isProduction()) {
            PostHog::capture(['distinctId' => $invited->user_id, 'event' => 'invite has response']);
        }

        return redirect()->route('register');//->with('status', 'Invitation response');
    }

    /**
     * Display a listing of the resource.
     */
    public function verifyPlayer(string $verifyCode, string $type)
    {
        try{
            $newPlayer = User::whereVerifyCode($verifyCode)->whereNull('email_verified_at')->firstOrFail();
        }catch(Exception $e) {
            return redirect()->route('login')->with('status', 'Verification failed - sign up required');
        }

        $newPlayer->update([
            'email_verified_at' => now(),
            'verify_code' => null,
        ]);

        if(App()->isProduction()) {
            PostHog::capture(['distinctId' => $newPlayer->id, 'event' => 'user verified']);
        }

        return redirect()->route('login')->with('status', 'Registration successfully');

    }

}
