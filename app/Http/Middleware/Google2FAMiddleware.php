<?php

namespace App\Http\Middleware;

use Closure;
use App\Support\Google2FAAuthentication;

class Google2FAMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $authentication = app(Google2FAAuthentication::class)->boot($request);
        if ($authentication->isAuthenticated()) {
            return $next($request);
        }

        return $authentication->makeRequestOneTimePasswordResponse();
    }
}
