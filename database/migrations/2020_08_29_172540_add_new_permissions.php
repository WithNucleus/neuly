<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class AddNewPermissions extends Migration
{
    private $oldPermission = 'edit listing requests';

    private $newPermissions = [
        'manage listing requests',
        'manage entity merge',
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::where('name' , $this->oldPermission)->delete();

        foreach ($this->newPermissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $adminRole = Role::where('name', 'Admin')->first();

        if ($adminRole !== null) {
            $adminRole->givePermissionTo($this->newPermissions);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::whereIn('name' , $this->newPermissions)->delete();
        Permission::create(['name' => $this->oldPermission]);

        $adminRole = Role::where('name', 'Admin')->first();

        if ($adminRole !== null) {
            $adminRole->givePermissionTo($this->oldPermission);
        }

    }
}
