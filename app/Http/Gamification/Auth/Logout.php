<?php

namespace App\Http\Gamification\Auth;

use Illuminate\Support\Facades\Auth;

use Livewire\Component;

use App\Models\User;

class Logout extends Component
{

    public function destroy()
    {
        if($user = User::find(auth()->id())){
            $user->update([
                'logout_at' => now(),
                'signout_times' => $user->signout_times + 1,
            ]);

            if(session()->has('next-route-num')){
                session()->forget('next-route-num');
            }

            Auth::logout();
        }
        
        return redirect()->route('login');
    }

    
    public function render()
    {
        return view('gamification.auth.logout');
    }
}
