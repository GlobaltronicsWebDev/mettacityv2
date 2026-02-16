<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsSuperAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !auth()->user()->is_super_admin) {
            return redirect()->route('admin.dashboard')->with('error', 'Only Super Admin can access this section.');
        }

        return $next($request);
    }
}
