<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateWithBearerToken
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();
        
        // Check if the bearer token is missing
        if (!$token) {
            return response()->json(['error' => 'Bearer token not provided'], Response::HTTP_UNAUTHORIZED);
        }
        
        // Validate the bearer token
        if ($token !== env('API_BEARER_TOKEN')) {
            return response()->json(['error' => 'Invalid bearer token'], Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
