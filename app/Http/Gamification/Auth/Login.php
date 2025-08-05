<?php

namespace App\Http\Gamification\Auth;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\{Auth, Http, Log};

use PostHog\PostHog;
use Livewire\Component;
use Livewire\Attributes\Url;
use Laravel\Socialite\Facades\Socialite;
use Jenssegers\Agent\Agent as JAgent;

use App\Models\LoginAttempt;

class Login extends Component
{
    #[Url]
    public $ref;

    public $email='';
    public $password='';
    public $passwordType = 'password';
    public $captcha = 0;

    protected $rules= [
        'email'     => 'required|email',
        'password'  => 'required'
    ];

    public function mount()
    {
        if(isset($this->ref)){
            session(['medsnapp_referral' => $this->ref]);
        }
    }

    public function redirectToGoogle(string $provider = 'google')
    {
        $targetUrl = Socialite::driver($provider)->redirect()->getTargetUrl();
        
        return redirect()->away($targetUrl);
    }

    public function render()
    {
        return view('gamification.auth.login');
    }

    public function togglePasswordType()
    {
        $this->passwordType = $this->passwordType === 'password' ? 'text' : 'password';
    }

    public function updatedCaptcha($token)
    {
        $response = Http::post('https://www.google.com/recaptcha/api/siteverify?secret=' . config('app.recaptcha_secret_key_v3') . '&response=' . $token);
        $this->captcha = $response->json()['score'];
     
        if (!$this->captcha > .3) {
            $this->store();
        } else {
            return redirect()->back()->with('status', 'Google thinks you are a bot, please refresh and try again');
        }
    }
    
    public function store(Request $req)
    {
        $ag = new JAgent();
        $attributes = $this->validate();

        if (!auth()->attempt($attributes)) {

            LoginAttempt::create([
                'email' => $attributes['email'],
                'ip_address' => $req->ip(),
                'user_agent' => $req->userAgent(),
            ]);

            throw ValidationException::withMessages([
                'password' => 'The email or password is incorrect.'
            ]);
        } else {
            LoginAttempt::create([
                'user_id' => auth()->id(),
                'email' => $attributes['email'],
                'ip_address' => $req->ip(),
                'user_agent' => $req->userAgent(),
                'success' => true,
                'extras' => [
                    'robot' => $ag->robot(),
                    'lang' => $ag->languages(),
                    'device' => $ag->device(),
                    'platform' => $ag->platform(),
                    'browser' => $ag->browser(),
                    'isMobile' => $ag->isMobile(),
                    'isTablet' => $ag->isTablet(),
                    'isDesktop' => $ag->isDesktop(),
                    'isPhone' => $ag->isPhone(),
                ],
            ]);
        }

        if(!auth()->user()->hasVerifiedEmail()) {
            Auth::logout();

            if(App()->isProduction()) {

                PostHog::capture(['distinctId' => auth()->user()->username ?? 'guest', 'event' => 'login unverified']);
            }

            return redirect()->back()->with('status', 'Player not verified, please verify first by clicking activate link on email sent');
        }else{
            if(auth()->user()->is_locked) {
                if(App()->isProduction()) {
                    PostHog::capture(['distinctId' => auth()->user()->username ?? 'guest', 'event' => 'login unsuccessfull ']);
                }

                return redirect()->back()->with('status', 'Account has locked, please contact administrator!');
            }
            
            session()->regenerate();

            if ($user = auth()->user()) {
                $user->login_at = now();
                $user->signin_times++;
                $user->save();

                // User onboarding start as is_active false
                if(!$user->is_active) {
                    session()->put('next-route-num', 0);
                }

                if($user->Role->role_name == 'Player') {
                    return redirect()->route('player-dashboard');
                }
            }
        }

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

        if($user->isAdmin) {
            // Log::info('Admin login ' . now()->format('d-m-Y H:i:s'));
            return redirect()->route('user-list'); //dashboard    
        }

        if($user->isOperator) {
            Log::info('Operator ('. $user->username .') login ' . now()->format('d-m-Y H:i:s'));
            $menu = [
                'patient-op' => 'patient-list',
                'question-op' => 'question-list',
                'blog-op' => 'post-list'
            ];

            return redirect()->route($menu[$user->username]);
        }
        
        return redirect()->route('player-dashboard');
    }
}
