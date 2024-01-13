<?php

namespace App\Http\Middleware;


use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminOrGuest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Check if the user is an admin or a guest
        $user = Auth::user();
        if (!Auth::check() || $user->admin) {
            return $next($request);
        }

        return redirect(RouteServiceProvider::HOME);
    }
}
