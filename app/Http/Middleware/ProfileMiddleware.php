<?php
/* DEPRECATED */
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Route;

class ProfileMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $profileRoute = 'player-profile';
        $shopRoute = 'shop';

        $user = $request->user();

        if(Route::currentRouteName() !== $profileRoute && !$user->is_active) {
            return redirect()->route($profileRoute);
        }

        if(Route::currentRouteName() === $shopRoute && $user->hasActiveQuest) {
            return redirect()->route('questboard');
        }

        return $next($request);
    }
}
