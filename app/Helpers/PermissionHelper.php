<?php

namespace App\Helpers;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;


class PermissionHelper
{
    /**
     * Get all permissions optionally grouped by a specific attribute.
     *
     * @param string|null $groupBy Attribute to group permissions by (e.g., 'guard_name').
     * @return array
     */
    public static function getAllPermissions(string $groupBy = null): array
    {
        $permissions = Permission::all();

        if ($groupBy) {
            return $permissions->groupBy($groupBy)->toArray();
        }

        return $permissions->pluck('name')->toArray();
    }

    /**
     * Get permissions for a specific controller from the config.
     *
     * @param string $controllerClass
     * @return array
     */
    public static function getControllerPermissions(string $controllerClass): array
    {
        $permissionsConfig = Config::get('permission.permissions');

        return $permissionsConfig[$controllerClass] ?? [];
    }

    /**
     * Check if the current user has any permissions for a given set of controllers.
     *
     * @param array $controllerClasses
     * @return bool
     */
    public static function hasControllerPermissions(array $controllerClasses): bool
    {
        foreach ($controllerClasses as $controllerClass) {
            $permissions = self::getControllerPermissions($controllerClass);

            foreach ($permissions as $permission) {
                if (Auth::check() && Auth::user()->can($permission)) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Get permissions associated with a specific role.
     *
     * @param string $roleName
     * @return array
     */
    public static function getPermissionsByRole(string $roleName): array
    {
        $role = Role::where('name', $roleName)->first();

        if (!$role) {
            return [];
        }

        return $role->permissions->pluck('name')->toArray();
    }

    /**
     * Check if a specific permission exists.
     *
     * @param string $permissionName
     * @return bool
     */
    public static function permissionExists(string $permissionName): bool
    {
        return Permission::where('name', $permissionName)->exists();
    }

    /**
     * Sync permissions dynamically by ensuring they exist in the database.
     *
     * @param array $permissions
     * @return void
     */
    public static function syncPermissions(array $permissions): void
    {
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }

    public static function syncPermissionsFromConfig(): void
    {
        // Fetch all controller-specific permissions
        $controllerPermissions = config('permission.permissions', []);
        
        // Flatten all controller permissions into a single array
        $controllerPermissions = collect($controllerPermissions)
            ->map(fn($actions) => array_values($actions))
            ->flatten()
            ->toArray();
    
        // Fetch middleware-specific permissions
        $middlewarePermissions = config('permission.middleware_permissions', []);
    
        // Flatten middleware permissions into a single array
        $middlewarePermissions = collect($middlewarePermissions)
            ->map(fn($actions) => array_values($actions))
            ->flatten()
            ->toArray();
    
        // Merge both arrays and remove duplicates
        $allPermissions = array_unique(array_merge($controllerPermissions, $middlewarePermissions));
    
        // Sync permissions in the database
        self::syncPermissions($allPermissions);
    }
    

    /**
     * Sync permissions for a controller by extracting them from the config.
     *
     * @param string $controllerClass
     * @return void
     */
    public static function syncControllerPermissions(string $controllerClass): void
    {
        $permissions = self::getControllerPermissions($controllerClass);

        if (!empty($permissions)) {
            self::syncPermissions(array_values($permissions));
        }
    }
}
