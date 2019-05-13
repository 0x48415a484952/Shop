<?php

namespace App\Http\Middleware;

use Closure;

class AccessControlAppending
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
        $response = $next($request);
        if ($request->getMethod() == 'OPTIONS') {
            // dd('ok');
            $response->header('Access-Control-Allow-Credentials', 'true');
            $response->header('Access-Control-Allow-Headers', 'Origin');
            $response->header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
            $response->header('Access-Control-Allow-Origin', 'http://localhost:3000');
            return $response;
        }
        // $response->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Content-Range, Content-Disposition, Content-Description, X-Auth-Token');
                           
        $response->header('Access-Control-Allow-Credentials', 'true');
        $response->header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
        $response->header('Access-Control-Allow-Headers', 'Origin');
        $response->header('Access-Control-Allow-Origin', 'http://localhost:3000');
        // $response->header('Access-Control-Allow-Origin', '*');
        //add more headers here
        return $response;
    }
}
