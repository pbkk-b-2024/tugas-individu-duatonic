<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        return view('sidebar-components.users-add');
    }

    // Show the form to edit an existing user
    public function edit($user_id)
    {
        $user = User::findOrFail($user_id);
        return view('sidebar-components.users-edit', compact('user'));
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
            'email' => 'required|string|max:100',
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
            'email' => 'required|string|max:100',
            'password' => 'required|string|max:50',
            'role_id' => 'required|char:6',
        ]);

        $user = User::findOrFail($user_id);
        $user->update([
            'user_name' => $request->name,
            'user_email' => $request->email,
            'user_pwd' => $request->password,
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('users')->with('success', 'User updated successfully.');
    }
}
