<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Add security headers to all requests
        $middleware->append(\App\Http\Middleware\SecurityHeaders::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Log all exceptions with full details
        $exceptions->report(function (Throwable $e) {
            \Log::error('Exception occurred', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'url' => request()->fullUrl(),
                'method' => request()->method(),
                'ip' => request()->ip(),
                'user_id' => auth()->id(),
            ]);
        });

        // Render generic error messages to users (hide sensitive details)
        $exceptions->render(function (Throwable $e, $request) {
            // Don't modify API responses or if debug mode is on
            if ($request->expectsJson() || config('app.debug')) {
                return null;
            }

            // Handle specific exceptions with user-friendly messages
            if ($e instanceof \Illuminate\Auth\AuthenticationException) {
                return redirect()->route('admin.login')
                    ->with('error', 'Please log in to continue.');
            }

            if ($e instanceof \Illuminate\Auth\Access\AuthorizationException) {
                return back()->with('error', 'You do not have permission to perform this action.');
            }

            if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return back()->with('error', 'The requested resource was not found.');
            }

            if ($e instanceof \Illuminate\Validation\ValidationException) {
                // Let validation errors pass through normally
                return null;
            }

            // For all other exceptions, show generic error
            if ($request->is('admin/*')) {
                return back()->with('error', 'An error occurred. Please try again or contact support if the problem persists.');
            }

            // For public pages, show a generic error page
            return response()->view('errors.generic', [
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        });
    })->create();
