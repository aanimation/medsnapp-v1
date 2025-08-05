<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class OnBoardMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $sessionNextRouteNum = $request->session()->get('next-route-num') ?? 0;
        $onboardRoutes = ['player-profile', 'help', 'shop', 'lobby'];

        $user = $request->user();

        // Onboard route if new user is not active yet , always redirect to current onboard session
        if(!$user->is_active){
            if(Route::currentRouteName() != $onboardRoutes[$sessionNextRouteNum]) {
                return redirect()->route($onboardRoutes[$sessionNextRouteNum]);
            }
        }

        // Force user to prevent visit shop where has active patient
        if(Route::currentRouteName() === 'shop' && $user->is_active && $user->hasActiveQuest && $user->username !== 'demo-user') {
            return redirect()->route('questboard');
        }

        return $next($request);
    }
}
