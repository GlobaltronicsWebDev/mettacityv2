<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            // Regenerate session ID to prevent session fixation attacks
            $request->session()->regenerate();
            
            // Store login time for session rotation
            $request->session()->put('last_activity', now());
            $request->session()->put('login_time', now());
            
            if (Auth::user()->is_admin) {
                // Secure redirect - only allow admin routes
                $intended = $request->session()->get('url.intended', '/admin/dashboard');
                
                // Validate that the intended URL is within admin area
                if (str_starts_with($intended, url('/admin'))) {
                    return redirect($intended);
                }
                
                return redirect('/admin/dashboard');
            }
            
            Auth::logout();
            return back()->withErrors([
                'email' => 'You do not have admin access.',
            ]);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        $userId = auth()->id();
        
        Auth::logout();
        
        // Invalidate the session
        $request->session()->invalidate();
        
        // Regenerate CSRF token
        $request->session()->regenerateToken();
        
        // Clear all session data
        $request->session()->flush();
        
        \Log::info('User logged out', ['user_id' => $userId]);
        
        return redirect('/');
    }
}
