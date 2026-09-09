<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EmployeeMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('employee.login');
        }

        if (Auth::user()->role !== 'employee') {
            abort(403);
        }

        if (!Auth::user()->status) {
            Auth::logout();

            return redirect()
                ->route('employee.login')
                ->with('error', 'Your account is inactive.');
        }

        return $next($request);
    }
}