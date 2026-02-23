<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visit;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class TrackVisit
{
    public function handle(Request $request, Closure $next): Response
    {
        // Don't track if user is logged in as admin
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        // Don't track bots and crawlers
        $userAgent = $request->userAgent();
        $botPatterns = [
            'bot', 'crawl', 'spider', 'slurp', 'mediapartners',
            'googlebot', 'bingbot', 'yahoo', 'baiduspider'
        ];
        
        foreach ($botPatterns as $pattern) {
            if (stripos($userAgent, $pattern) !== false) {
                return $next($request);
            }
        }

        // Track the visit
        Visit::create([
            'ip_address' => $request->ip(),
            'user_agent' => $userAgent,
            'page' => $request->path(),
            'visited_at' => now(),
        ]);

        return $next($request);
    }
}
