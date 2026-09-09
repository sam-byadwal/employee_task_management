<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeAuthController extends Controller
{
    public function showLogin()
    {
    
        if (Auth::check() && Auth::user()->role === 'employee') {
            return redirect()->route('employee.dashboard');
        }

        return view('employee.auth.login');
    }

    public function login(Request $request)
    {

  
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);


        
        $remember = $request->boolean('remember');

        if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'role' => 'employee',
            'status' => true,
        ], $remember)) {

            $request->session()->regenerate();

            return redirect()->route('employee.dashboard');
        }

        return back()
            ->withErrors([
                'email' => 'Invalid employee credentials.',
            ])
            ->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('employee.login')
            ->with('success', 'You have been logged out successfully.');
    }
}