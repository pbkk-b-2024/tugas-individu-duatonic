<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $searchTerm = $request->input('search');

        $data['users'] = User::search($searchTerm)->paginate(20); // Fetch all users from the database

        return view('sidebar-components.users', compact('data'));
    }

    public function add()
    {
        $roles = Role::all();
        return view('sidebar-components.users-add', compact('roles'));
    }

    // Show the form to edit an existing user
    public function edit($user_id)
    {
        $user = User::findOrFail($user_id);
        $roles = Role::all();

        \Log::info('Edit for user', ['user_id' => $user->name]);
        return view('sidebar-components.users-edit', compact('user', 'roles'));
    }

    public function destroy($user_id)
    {
        $user = User::findOrFail($user_id); // Find the user by its ID
        $user->delete(); // Delete the user from the database
        return redirect()->back()->with('success', 'User deleted successfully');
    }

    public function store(Request $request)
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

        return redirect()->route('users')->with('success', 'User added successfully.');
    }

    // Update the specified user in the database
    public function update(Request $request, $user_id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100',
            'password' => 'required|string|max:80',
            'role_id' => 'required|string|size:6',
        ]);

        $user = User::findOrFail($user_id);

        $user->update([
            'user_name' => $request->name,
            'user_email' => $request->email,
            'user_pwd' => $request->password ? Hash::make($request->password) : $user->user_pwd,
            'role_id' => $request->role_id,
        ]);

        \Log::info('User updated', ['user_id' => $user->user_id]);

        return redirect()->route('users')->with('success', 'User updated successfully.');
    }
}
