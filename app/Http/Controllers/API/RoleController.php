<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Http\Requests\NewRoleRequest;
use App\Http\Resources\RoleResource;

class RoleController
{
    public function index(Request $request)
    {
        $searchTerm = $request->input('search');

        $query = Role::search($searchTerm)->paginate(20); // Fetch all roles from the database

        if (!$query) {
            return response()->json([
                'success' => false,
                'message' => 'Roles not found',
            ], 404);
        } else {
            return response()->json($query);
        }
    }

    public function single($role_id)
    {
        $role = Role::findOrFail($role_id);

        if (!$role) {
            return response()->json([
                'success' => false,
                'message' => 'Role not found',
            ], 404);
        } else {
            return response()->json($role);
        }
    }

    public function store(NewRoleRequest $request)
    {
        $validated = $request->validated();
        $role = Role::create($validated);
        return (new RoleResource($role))->additional([
            'success' => true,
            'message' => 'Role added successfully',
        ]);
    }

    public function update(NewRoleRequest $request, $role_id)
    {
        $validated = $request->validated();
        $role = Role::findOrFail($role_id);
        if (!$role) {
            return response()->json([
                'success' => false,
                'message' => 'Role not found',
            ], 404);
        }
        $role->update($validated);
        return (new RoleResource($role))->additional([
            'success' => true,
            'message' => 'Role updated successfully',
        ]);
    }

    public function destroy($role_id)
    {
        $role = Role::findOrFail($role_id); // Find the role by its ID
        if (!$role) {
            return response()->json([
                'success' => false,
                'message' => 'Role not found',
            ], 404);
        }
        $role->delete(); // Delete the role from the database
        return response()->json([
            'success' => true,
            'message' => 'Role deleted successfully',
        ]);
    }
}