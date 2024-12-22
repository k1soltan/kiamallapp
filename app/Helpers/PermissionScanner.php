<?php



namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class PermissionScanner
{
    /**
     * Sync permissions based on a predefined list.
     *
     * @param array $definedPermissions
     */
    public static function sync(array $definedPermissions)
    {
        // Get existing permissions from the database
        $existingPermissions = DB::table('permissions')->pluck('name')->toArray();

        // Identify unused permissions and delete them
        $permissionsToDelete = array_diff($existingPermissions, $definedPermissions);
        foreach ($permissionsToDelete as $permissionName) {
            DB::table('permissions')->where('name', $permissionName)->delete();
        }

        // Identify new permissions and add them
        $permissionsToAdd = array_diff($definedPermissions, $existingPermissions);
        foreach ($permissionsToAdd as $permissionName) {
            DB::table('permissions')->insert(['name' => $permissionName, 'created_at' => now(), 'updated_at' => now()]);
        }
    }
}
