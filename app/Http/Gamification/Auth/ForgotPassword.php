<?php

namespace App\Http\Gamification\Auth;

use PostHog\PostHog;
use Livewire\Component;

use App\Notifications\ResetPassword;
use Illuminate\Notifications\Notifiable;

use App\Models\User;

class ForgotPassword extends Component
{
    use Notifiable;

    public $email='';
    
    protected $rules = [
        'email' => 'required|email:exists:users,email',
    ];

    public function render()
    {
        return view('gamification.auth.forgot-password');
    }

    public function routeNotificationForMail() {
        return $this->email;
    }

    public function show()
    {
        $this->validate();

        $user = User::where('email', $this->email)->first();
        
        if(!$user) {
            return back()->with('email', "Email address not found in platform");
        }

        $this->notify(new ResetPassword($user->id));

        if(App()->isProduction()) {
            PostHog::capture([
                'distinctId' => auth()->user()->username ?? 'guest',
                'event' => 'user forgot password',
                'properties' => [
                    '$set_once' => ['initial_url' => url()->current()],
                ]
            ]);
        }

        return back()->with('status', "Password reset link has been sent!");
    }
}
