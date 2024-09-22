<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $searchTerm = $request->input('search');

        $data['roles'] = Role::search($searchTerm)->paginate(20); // Fetch all roles from the database

        return view('sidebar-components.roles', compact('data'));
    }

    public function add()
    {
        return view('sidebar-components.roles-add');
    }

    // Show the form to edit an existing role
    public function edit($role_id)
    {
        $role = Role::findOrFail($role_id);
        return view('sidebar-components.roles-edit', compact('role'));
    }

    public function destroy($role_id)
    {
        $role = Role::findOrFail($role_id); // Find the role by its ID
        $role->delete(); // Delete the role from the database
        return redirect()->back()->with('success', 'Role deleted successfully');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'desc' => 'required|string|max:255',
        ]);

        Role::create([
            'role_name' => $request->name,
            'role_description' => $request->desc,
        ]);

        return redirect()->route('roles')->with('success', 'Role added successfully.');
    }

    // Update the specified role in the database
    public function update(Request $request, $role_id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'desc' => 'required|string|max:255',
        ]);

        $role = Role::findOrFail($role_id);
        $role->update([
            'role_name' => $request->name,
            'role_description' => $request->desc,
        ]);

        return redirect()->route('roles')->with('success', 'Role updated successfully.');
    }
}