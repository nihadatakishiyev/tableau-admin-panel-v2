<?php

namespace App\Http\Middleware;

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
        if (Auth::check()){
            DB::table('page_visit_logs')->insert([
                'user_id' => Auth::user()->id,
                'ip_address' => request()->ip(),
                'page_url' => $request->url(),
                'created_at' => now()
            ]);
        }


        return $next($request);
    }
}
