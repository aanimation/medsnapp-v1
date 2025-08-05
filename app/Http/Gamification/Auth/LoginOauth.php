<?php

namespace App\Http\Gamification\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\{Auth, Hash, Log};
use Exception;

use Livewire\Component;
use Laravel\Socialite\Facades\Socialite;

use App\Models\User;

class LoginOauth extends Component
{

    public function mount()
    {
        $this->handleCallback();
    }

    function handleCallback()
    {
        $userG = null;

        try {
            $userG = Socialite::driver('google')->stateless()->user();
        } catch (Exception $e) {
            Log::error(['message' => $e->getMessage(), 'loc' => 'handleCallback']);
        }

        if(is_null($userG)){
            return redirect()->route('login');
        }

        // If user exists in record, then update
        if($user = User::whereGoogleId($userG->getId())->first()) {
            $user->updateQuietly([
                'signin_times' => $user->signin_times + 1,
                'login_at' => now()
            ]);
        }elseif($user = User::whereEmail($userG->getEmail())->first()) {
            $user->update([
                'google_id' => $userG->getId(),
                'signin_times' => $user->signin_times + 1,
                'login_at' => now(),
                'email_verified_at' => $user->email_verified_at ?? now(),
                'verify_code' => null
            ]);
        }else{
            // check user is_deleted status
            if(User::whereEmail($userG->getEmail())->whereIsDeleted(true)->withTrashed()->first()){
                return redirect()->route('login')->with('status', 'Account was deactivated. Please contact to re-activate account');
            }

            $user = User::create([
                'role_id' => 3,
                'email' => $userG->getEmail(),
                'google_id' => $userG->getId(),
                'password' => Hash::make($userG->getId()),
                'username' => Str::slug($userG->getNickname() ?? $userG->getName()),
                'name' => explode(' ', $userG->getName())[0] ?? $userG->getName(),
                'email_verified_at' => now(),
                'verify_code' => null,
                'signin_times' => 1,
                'login_at' => now(),
            ]);

            $user = $user->fresh();
        }

        Auth::login($user);

        // User onboarding start as is_active false
        if(!$user->is_active) {
            session()->put('next-route-num', 0);
            return redirect()->route('player-profile');
        }

        return redirect()->route('player-dashboard');
    }

    public function render()
    {
        return view('gamification.auth.login-oauth');
    }
}
