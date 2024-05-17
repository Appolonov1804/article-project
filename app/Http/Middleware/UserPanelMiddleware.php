<?php
namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
namespace App\Http\Controllers\Auth;

class UserPanelMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->isEditor()) {
            return $next($request);
        }

        return redirect()->route('home')->with('error', 'У вас нет доступа к этой странице.');
    }
}