<?php

namespace App\Http\Gamification\Auth;

use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use PostHog\PostHog;
use Livewire\Component;

use App\Models\User;



class ResetPassword extends Component
{
    public $email = '';
    public $password = '';
    public $urlID = '';
    public $passwordType = 'password';

    protected function rules() {
        return [
            'email'    => 'required|email',
            'password' => ['required','string', Password::defaults()->mixedCase()->numbers()->symbols()],
        ];
    }

    protected function messages() {
        return [
            'password.required' => 'req',
            'password.min' => 'min',
            'password.mixed' => 'mix',
            'password.symbols' => 'sym',
            'password.numbers' => 'num',
        ];
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function render()
    {
        return view('gamification.auth.reset-password');
    }

    public function togglePasswordType()
    {
        $this->passwordType = $this->passwordType === 'password' ? 'text' : 'password';
    }

    public function mount($id) {
        if($existingUser = User::find($id)){
            $this->urlID = intval($existingUser->id);
            $this->email = $existingUser->email;
        }
    }

    public function update()
    {    
        $this->validate();
          
        $existingUser = User::where('email', $this->email)->first();

        if($existingUser && $existingUser->id == $this->urlID) { 
            $existingUser->updateQuietly([
                'password' => Hash::make($this->password)
            ]);

            if(App()->isProduction()) {
                PostHog::capture(['distinctId' => auth()->user()->username ?? 'guest', 'event' => 'Reset password']);
            }

            return redirect()->route('login')->with('status', 'Your password has been reset!');
        } else {
            return back()->with('email', "We can't find any user with that email address.");
        }
    
    }

}
