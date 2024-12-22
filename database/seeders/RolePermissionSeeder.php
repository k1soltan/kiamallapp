<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Log;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Load permissions from config
        $permissionsConfig = config('permission.permissions');

        // Extract unique permission names
        $permissions = collect($permissionsConfig)
            ->flatMap(fn ($methods) => array_values($methods))
            ->unique()
            ->toArray();

        // Create or update permissions
        foreach ($permissions as $permission) {
            $newPermission = Permission::firstOrCreate(['name' => $permission]);
            Log::info("Permission created or updated: {$newPermission->name}");
        }

        // Cleanup: Remove permissions not in the list
        $deletedPermissions = Permission::whereNotIn('name', $permissions)->pluck('name')->toArray();
        Permission::whereNotIn('name', $permissions)->delete();
        if (!empty($deletedPermissions)) {
            Log::warning("Removed unused permissions: " . implode(', ', $deletedPermissions));
        }

        // Ensure the admin role exists
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        Log::info("Role created or verified: {$adminRole->name}");

        // Assign all permissions to the admin role
        $adminRole->syncPermissions($permissions);
        Log::info("Permissions synced to role: {$adminRole->name}");

        // Assign the admin role to a specific user
        $adminEmail = env('ADMIN_EMAIL', 'admin@example.com'); // Configurable email
        $adminUser = \App\Models\User::where('email', $adminEmail)->first();

        if ($adminUser) {
            $adminUser->assignRole('admin');
            Log::info("Admin role assigned to user: {$adminEmail}");
        } else {
            Log::warning("No user found with email: {$adminEmail}. Role assignment skipped.");
        }
    }
}

