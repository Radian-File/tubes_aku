<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiKeyMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // For web application, check if user is authenticated instead of API key
        // This allows both authenticated users and API key authentication
        $apiKey = $request->header('API_KEY');

        // If API key is provided, validate it
        if ($apiKey) {
            if ($apiKey !== env('APP_KEY')) {
                return response()->json(['error' => 'Invalid API Key'], 401);
            }
        } else {
            // If no API key, require authentication for web requests
            if (!auth()->check()) {
                return response()->json(['error' => 'Authentication required'], 401);
            }
        }

        return $next($request);
    }
}
