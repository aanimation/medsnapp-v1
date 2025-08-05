<?php

namespace App\Http\Gamification\Auth;

use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\{Http, Log};
use Exception;

use PostHog\PostHog;
use Livewire\Component;
use Livewire\Attributes\Url;
use Laravel\Socialite\Facades\Socialite;

use App\Traits\WithReferral;
use App\Models\User;

class Register extends Component
{
    use WithReferral;

    #[Url]
    public $ref;

    public $is_verified = false;

    public $email = '';
    public $password = '';
    public $captcha = 0;
    public $passwordType = 'password';

    protected function rules() {
        return [
            'is_verified'   => 'required',
            'email'         => 'required|email|unique:users,email',
            'password'      => ['required','string', Password::defaults()->mixedCase()->numbers()->symbols()],
            'captcha'       => 'required'
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

    public function mount()
    {
        // Init referral session
        if(isset($this->ref)){
            session(['medsnapp_referral' => $this->ref]);
        }

        if(App()->isProduction()) {
            PostHog::capture([
                'distinctId' => 'guest',
                'event' => '$set',
                'properties' => [
                    '$set' => ['name' => 'guest', 'email' => 'none'],
                    '$set_once' => ['initial_url' => url()->current()],
                ]
            ]);
        }
    }

    public function redirectToGoogle(string $provider = 'google')
    {
        $targetUrl = Socialite::driver($provider)->redirect()->getTargetUrl();
        
        return redirect()->away($targetUrl);
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function updatedCaptcha($token)
    {
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $response = Http::post($url . '?secret=' . config('app.recaptcha_secret_key_v3') . '&response=' . $token);
        $this->captcha = $response->json()['score'];

        if (!$this->captcha > .3) {
            $this->store();
        } else {
            return redirect()->back()->with('status', 'Google thinks you are a bot, please refresh and try again');
        }
    }

    public function store()
    {
        $attributes = $this->validate(); 

        try{
            $tempName = explode('@', $attributes['email'])[0];
            $attributes['name'] = $this->getUniquePlayerName($tempName);

            User::create($attributes);
        }catch(Exception $e) {
            Log::error('Exception: ' . $e->getMessage());
            return redirect()->back()->with('status', 'Register new user failed, please try again.');
        }
        
        return redirect()->route('login')->with('status', 'An activation link has been sent to your registered email');
    }

    public function render()
    {
        return view('gamification.auth.register');
    }

    public function togglePasswordType()
    {
        $this->passwordType = $this->passwordType === 'password' ? 'text' : 'password';
    }

    public function getUniquePlayerName($tempName)
    {
        if(User::whereName($tempName)->exists()){
            $tempName = $tempName.random_int(10, 99);
        } 

        return $tempName;
    }
}
