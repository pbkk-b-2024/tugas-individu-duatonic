<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
// use App\Models\User;

class LoginController
{
    public function loginForm()
    {
        \Log::info('Session data:', ['session' => session()->all()]);
        if (Auth::check()) {
            \Log::info('You in!', ['email' => Auth::id()]);
            return redirect()->intended();
        }
        \Log::info('Login form requested');
        return view('auth.login');
    }

    public function login(Request $request)
    {
        \Log::info('Login method called');

        $credentials = $request->validate([
            'user_email' => 'required|email',
            'password' => 'required',
        ]);

        \Log::info('Credentials validated', $credentials);

        if (Auth::attempt($credentials)) {
            \Log::info('User authenticated', ['email' => Auth::id()]);

            $request->session()->regenerate();

            \Log::info('User logged in and session regenerated');

            return redirect()->intended(route('home'))->with('success', 'You have been logged in.');
        }

        // // Query the users table for the provided email
        // $user = User::where('user_email', $credentials['email'])->first();

        // // Check if the user exists and the password matches
        // if ($user && Hash::check($credentials['password'], $user->user_pwd)) {
        //     \Log::info('User authenticated', ['user_id' => $user->user_id]);

        //     // Log the user in
        //     Auth::login($user);
        //     $request->session()->regenerate();

        //     \Log::info('User logged in and session regenerated');

        //     return redirect()->route('home')->with('success', 'You have been logged in.');
        // }

        \Log::info('Invalid credentials');

        return back()->withErrors([
            'email' => 'Invalid e-mail or password.',
        ]);
    }

    public function logout(Request $request)
    {
        \Log::info('Session data:', ['session' => $request->session()->all()]);

        Auth::logout();
        Session::flush();

        \Log::info('User logged out');
        return redirect()->route('login')->with('success', 'You have been logged out.');
    }
}