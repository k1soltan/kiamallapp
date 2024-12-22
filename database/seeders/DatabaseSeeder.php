<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Helpers\PermissionHelper;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Create roles
        $roles = ['admin', 'employee', 'staff', 'partner', 'member'];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }


        // Create admin user if not exists
        if (env('ADMIN_EMAIL') && env('ADMIN_PASSWORD')) {
            $admin = User::firstOrCreate(
                ['email' => env('ADMIN_EMAIL')],
                [
                    'name' => 'Admin',
                    'password' => bcrypt(env('ADMIN_PASSWORD')),
                ]
            );

            $admin->assignRole('admin');
        }
 // Load permissions from config
        $permissionsConfig = config('permission.permissions');
           // Extract unique permission names
           $permissions = collect($permissionsConfig)
           ->flatMap(fn ($methods) => array_values($methods))
           ->unique()
           ->toArray();

              // Create or update permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign permissions to admin role
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->syncPermissions($permissions);
        PermissionHelper::syncPermissionsFromConfig();


    }
}

