<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\NewUserRequest;
use App\Http\Resources\UserResource;

class UserController
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

    public function single($user_id)
    {
        $user = User::findOrFail($user_id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        } else {
            return response()->json($user);
        }
    }

    public function store(NewUserRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);
        return (new UserResource($user))->additional([
            'success' => true,
            'message' => 'User added successfully',
        ]);
    }

    public function update(NewUserRequest $request, $user_id)
    {
        $validated = $request->validated();
        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }
        $user = User::findOrFail($user_id);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        }
        $user->update($validated);
        return (new UserResource($user))->additional([
            'success' => true,
            'message' => 'User updated successfully',
        ]);
    }

    public function destroy($user_id)
    {
        $user = User::findOrFail($user_id); // Find the user by its ID
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        }
        $user->delete(); // Delete the user from the database
        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully',
        ]);
    }
}