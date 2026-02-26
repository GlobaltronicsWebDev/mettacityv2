<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RotateSession
{
    /**
     * Handle an incoming request.
     * Rotates session ID periodically (similar to refresh token rotation)
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()) {
            $lastActivity = $request->session()->get('last_activity');
            
            // Rotate session every 24 hours (like refresh token rotation)
            if ($lastActivity && now()->diffInHours($lastActivity) >= 24) {
                // Regenerate session ID
                $request->session()->regenerate();
                
                // Update last activity time
                $request->session()->put('last_activity', now());
                
                \Log::info('Session rotated', [
                    'user_id' => $request->user()->id,
                    'ip' => $request->ip(),
                ]);
            }
            
            // Check if session is older than 7 days - force re-login
            $loginTime = $request->session()->get('login_time');
            if ($loginTime && now()->diffInDays($loginTime) >= 7) {
                auth()->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                
                return redirect()->route('admin.login')
                    ->with('error', 'Your session has expired. Please log in again.');
            }
        }
        
        return $next($request);
    }
}
