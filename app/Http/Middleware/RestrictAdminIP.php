<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestrictAdminIP
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get allowed IPs from environment variable or config
        $allowedIPs = config('admin.allowed_ips', []);
        
        // Get the user's REAL IP address (not spoofable)
        $userIP = $request->server('REMOTE_ADDR'); // Use REMOTE_ADDR instead of ip()
        
        // If no IPs are configured, allow all (for development)
        if (empty($allowedIPs)) {
            return $next($request);
        }
        
        // Check if user's IP is in the allowed list
        if (!in_array($userIP, $allowedIPs)) {
            \Log::warning('Unauthorized admin access attempt', [
                'ip' => $userIP,
                'forwarded_for' => $request->header('X-Forwarded-For'),
                'url' => $request->fullUrl(),
            ]);
            abort(403, 'Access denied. Your IP address is not authorized to access the admin panel.');
        }
        
        return $next($request);
    }
}
