<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visit;
use Symfony\Component\HttpFoundation\Response;

class TrackVisit
{
    public function handle(Request $request, Closure $next): Response
    {
        // Track the visit
        Visit::create([
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'page' => $request->path(),
            'visited_at' => now(),
        ]);

        return $next($request);
    }
}
