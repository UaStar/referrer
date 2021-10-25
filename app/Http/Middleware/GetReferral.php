<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class GetReferral
{
    const COOKIE_LIFETIME = 86400 * 30;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->has('ref')) {
            Cookie::queue('referrer', $request->query('ref'), self::COOKIE_LIFETIME);
            Cookie::queue('referral_link', $request->fullUrl(), self::COOKIE_LIFETIME);
        }

        return $next($request);
    }
}
