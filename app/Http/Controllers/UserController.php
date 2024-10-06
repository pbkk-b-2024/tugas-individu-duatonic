<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::search($search)->paginate(20);

        return view('main.users', compact('users'));
    }

    public function add()
    {
        $roles = Role::all();
        return view('main.partials.user-add', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'exists:'.Role::class.',role_id'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role,
        ]);

        return redirect()->route('users.index')->with('status', 'User created!');
    }

    public function edit($user_id)
    {
        $user = User::findOrFail($user_id);
        $roles = Role::all();

        \Log::info('Edit for user', ['user_id' => $user->user_id]);
        return view('main.partials.user-edit', compact('user', 'roles'));
    }

    public function update(Request $request, $user_id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users,email,'.$user_id.',user_id'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'exists:'.Role::class.',role_id'],
        ]);
        
        $user = User::findOrFail($user_id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'role_id' => $request->role,
        ]);

        \Log::info('User updated', ['user_id' => $user->user_id]);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        \Log::info('User deleted', ['user_id' => $user->user_id]);

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
