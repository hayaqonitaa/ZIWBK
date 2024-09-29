<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginCover extends Controller
{
    public function index()
    {
        $pageConfigs = ['myLayout' => 'blank'];
        return view('content.authentications.auth-login-cover', ['pageConfigs' => $pageConfigs]);
    }

    public function authenticate(Request $request)
    {
        // Validate the input
        $credentials = $request->validate([
            'email-username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt to login using email or username
        if (Auth::attempt(['email' => $credentials['email-username'], 'password' => $credentials['password']]) || 
            Auth::attempt(['name' => $credentials['email-username'], 'password' => $credentials['password']])) {
            // Authentication passed, redirect to homepage
            return redirect()->intended('/dashboard');
        }

        // Authentication failed, redirect back with error
        return back()->withErrors([
            'email-username' => 'Invalid credentials provided.',
        ])->onlyInput('email-username');
    }

    public function logout(Request $request)
    {
        // Log the user out
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the session token to prevent CSRF attacks
        $request->session()->regenerateToken();

        // Redirect the user to the login page
        return redirect()->route('auth-login-cover');
    }
}
