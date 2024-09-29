<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController
{
    public function showRegistrationForm()
    {
        $roles = Role::all();
        return view('auth.register', compact('roles'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users,user_email',
            'password' => 'required|string|max:50',
            'role_id' => 'required|string|size:6',
        ]);

        User::create([
            'user_name' => $request->name,
            'user_email' => $request->email,
            'user_pwd' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    }
}