<?php

namespace App\Http\Middleware;

use App\Jobs\LogPageVisits;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TrackPageVisits
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        LogPageVisits::dispatchAfterResponse($request);
        return $next($request);
    }
}
