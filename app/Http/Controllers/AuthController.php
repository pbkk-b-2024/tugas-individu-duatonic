<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class AuthController extends Controller
{
    public function loginForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        \Log::info('Login method called');

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        \Log::info('Credentials validated', $credentials);

        // Query the users table for the provided email
        $user = User::where('user_email', $credentials['email'])->first();

        // Check if the user exists and the password matches
        if ($user && Hash::check($credentials['password'], $user->user_pwd)) {
            \Log::info('User authenticated', ['user_id' => $user->user_id]);

            // Log the user in
            Auth::login($user);
            $request->session()->regenerate();

            \Log::info('User logged in and session regenerated');

            return redirect()->route('home')->with('success', 'You have been logged in.');
        }

        \Log::info('Invalid credentials');

        return back()->withErrors([
            'email' => 'Invalid e-mail or password.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('login')->with('success', 'You have been logged out.');
    }
}