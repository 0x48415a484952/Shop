<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // if ($request->user() && $request->user()->role != 'admin') return response()->json(['status' => 'Unauthorized user'], 400);
        //dd(JWTAuth::User()->role);
        if (JWTAuth::User()->role != 'admin') return response()->json(['status' => 'Unauthorized user'], 400);
        return $next($request);
    }
}
