<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::paginate(10);
        $permissions = Permission::all();
        $users = User::all();

        return view('admin.roles.index', compact('roles', 'permissions', 'users'));
    }

    public function create()
    {
        return view('admin.roles.create'); // Ensure this view exists
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles',
        ]);

        Role::create(['name' => $validated['name']]);

        return redirect()->route('admin.roles.index')->with('success', 'Role created successfully.');
    }

    public function assignPermissions(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.assign-permissions', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
{
    $this->authorize('edit roles');  // Ensure the user has the necessary permission

    // Validate the input
    $request->validate([
        'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
    ]);

    // Update the role
    $role->update([
        'name' => $request->name,
    ]);

    // Redirect with success message
    return redirect()->route('admin.roles.index')->with('success', __('Role updated successfully!'));
}

    public function edit(Role $role)
    {
        // Authorize the action (optional, based on your app's setup)
        $this->authorize('edit roles');

        // Pass the role to the view for editing
        return view('admin.roles.edit', compact('role'));
    }
    public function handleAssignPermissions(Request $request, Role $role)
    {
        $request->validate([
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $permissions = Permission::whereIn('id', $request->permissions)->get();

        try {
            // Add permissions without removing existing ones
            foreach ($permissions as $permission) {
                if (!$role->hasPermissionTo($permission)) {
                    $role->givePermissionTo($permission);
                }
            }

            return redirect()->route('admin.roles.index')->with('success', 'Permissions assigned to role successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to assign permissions: ' . $e->getMessage());
        }
    }

    public function viewPermissions(Role $role)
{
    $permissions = $role->permissions; // Get permissions associated with the role
    return view('admin.roles.view-permissions', compact('role', 'permissions'));
}

    public function assignRoleToUserView(Role $role)
    {
        $users = User::all();
        return view('admin.roles.assign-role-to-user', compact('role', 'users'));
    }

    public function assignRoleToUser(Request $request, Role $role)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::findOrFail($request->user_id);

        try {
            $user->assignRole($role->name);
            return redirect()->route('admin.roles.index')->with('success', 'Role assigned to user successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to assign role: ' . $e->getMessage());
        }
    }
    public function destroy(Role $role)
{
    try {
        $role->delete();
        return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully.');
    } catch (\Exception $e) {
        return redirect()->route('admin.roles.index')->with('error', 'Failed to delete role: ' . $e->getMessage());
    }
}
public function removePermissionFromRole(Request $request, Role $role)
{
    $request->validate([
        'permission_id' => 'required|exists:permissions,id',
    ]);

    $permission = Permission::findOrFail($request->permission_id);

    try {
        // Remove the permission from the role
        if ($role->hasPermissionTo($permission)) {
            $role->revokePermissionTo($permission);
        }
        return redirect()->back()->with('success', 'Permission removed from role successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Failed to remove permission: ' . $e->getMessage());
    }
}

}
