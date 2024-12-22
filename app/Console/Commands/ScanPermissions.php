<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


use Spatie\Permission\Models\Permission;
use App\Helpers\PermissionScanner;

class ScanPermissions extends Command
{
    protected $signature = 'permissions:scan';
    protected $description = 'Scan controller methods and register permissions';

    public function handle()
    {
        $permissions = PermissionScanner::scan();
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $this->info('Permissions scanned and registered successfully!');
    }
}
