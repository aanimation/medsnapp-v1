<?php

namespace App\Http\Gamification\User;

use Illuminate\Support\Facades\{Http, Log};
use Exception;

use PostHog\PostHog;
use Livewire\Component;

use App\Models\User;

class Learnboard extends Component
{
    const PLAYER = 'Player';

    public User $currentUser;
    public int $increment = 10;
    public int $decrement = -10;

    public function boot()
    {
        $this->currentUser = auth()->user();

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

    public function render()
    {
        $user = $this->currentUser;

        return view('gamification.user.learnboard');
    }

    public function beehiivDebug()
    {
        // make.com webhook
        $response = Http::post(config('services.make.webhook_url'), [
            'email' => 'development@medsnap.com',
            'firstname' => 'Dev',
            'lastname' => 'Guy',

            'country' => 'Indonesia',
            'university' => '',
            'type' => '',
            'student_type' => '',
            'profession' => '',
        ]);

        dump($response->body(), $response->object());

        // BeeHive Auto Subscription
        $beehiivConfigs = config('services.beehiiv');
        $url = "{$beehiivConfigs['url']}/{$beehiivConfigs['api_v2']['publication_id']}/subscriptions";
        $token = $beehiivConfigs['api_key'];
        try {
            $response = Http::withToken($token)->post($url,[
                'email' => auth()->user()->email,
                // 'utm_source' => config('app.name'),
                // 'utm_medium' => 'user-register',
                // 'referring_site' => config('app.platform_url'),
                'custom_fields' => [
                    [
                        'name' => "First Name",
                        'value'=> auth()->user()->username
                    ]
                ]
            ]);
            // Log::info($response->getBody());
        } catch(Exception $e) {
            Log::info($e->getMessage());
        }

        dd($response->body(), $response->object());
    }
}
