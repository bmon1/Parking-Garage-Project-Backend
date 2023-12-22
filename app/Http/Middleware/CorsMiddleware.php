<?php

namespace App\Http\Middleware;

use Closure;

class CorsMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Add CORS headers
        $response->header('Access-Control-Allow-Origin', 'http://localhost:5174');
        $response->header('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS');
        $response->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-XSRF-TOKEN');
        $response->header('Access-Control-Allow-Credentials', 'true');

        return $response;
    }
}
