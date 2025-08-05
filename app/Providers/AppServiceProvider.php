<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Validation\Rules\Password;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

use Enigma\GoogleChatHandler;
use PostHog\PostHog;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if(App()->isProduction()){
            GoogleChatHandler::$additionalLogs = function () {
                return [
                    'tenant' => auth()->user()->name ?? 'guest',
                    'request' => json_encode(request()->toArray()),
                ];
            };

            PostHog::init(
                'phc_HOsNCPLdO9IAsmiQ9VLKoX4OSwbroxQQh9sCvvoyYr2',
                [
                    'host' => 'https://us.i.posthog.com'
                ]
            );

        }

        /*
        https://stackoverflow.com/questions/72061652/how-to-implement-laravel-password-validation-rules-as-string-in-arrays
        [
        'password' => [
            'required',
            'string',
            Password::min(8)
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised(),
            'confirmed'
        ],
        */

        Password::defaults(function () {
            $rule = Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised();
 
            return app()->isProduction() ? $rule : Password::min(8);
        });

        // Not working yet
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->line('Hi!')
                ->subject('Verify Email Address')
                ->line('Click the button below to verify your email address.')
                ->action('Verify Email Address', $url);
        });
    }

    // protected function bootMacros()
    // {
    //     Component::macro('modalM', function($text){
    //         $this->js(<<<JS
    //             Swal.fire('', '{$text}', 'success');
    //         JS);
    //     });
    // }
}
