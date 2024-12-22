<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;

class SyncPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permissions:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync application permissions defined in configuration.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Fetch permissions from the config
        $permissionsConfig = config('permissions');

        // Merge permissions and middleware_permissions into a single array
        $permissions = collect($permissionsConfig['permissions'] ?? [])
            ->merge($permissionsConfig['middleware_permissions'] ?? [])
            ->flatMap(function ($actions) {
                return array_values($actions);
            })
            ->unique()
            ->values();

        // Sync permissions in the database
        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName]);
            $this->info("Synced permission: {$permissionName}");
        }

        $this->info('All permissions have been synced successfully!');
    }
}
