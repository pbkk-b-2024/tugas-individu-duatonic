<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $roles = Role::search($search)->paginate(20);

        return view('main.roles', compact('roles'));
    }

    public function add()
    {
        return view('main.partials.role-add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_name' => ['required', 'string', 'max:255'],
            'role_description' => ['required', 'string', 'max:255'],
        ]);
    
        Role::create([
            'role_name' => $request->role_name,
            'role_description' => $request->role_description,
        ]);
    
        return redirect()->route('roles.index')->with('success', 'Role added successfully.');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);

        return view('main.partials.role-edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'role_name' => ['required', 'string', 'max:255'],
            'role_description' => ['required', 'string', 'max:255'],
        ]);
        
        $role = Role::findOrFail($id);

        $role->update([
            'role_name' => $request->role_name,
            'role_description' => $request->role_description,
        ]);

        \Log::info('Role updated', ['id' => $role->role_id]);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        \Log::info('Role deleted', ['id' => $role->role_id]);

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
