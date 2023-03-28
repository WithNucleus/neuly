<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permission = Permission::create(['name' => 'enterprise demo']);
        $admin = Role::where(['name' => 'Admin'])->first();
        $enterprise = Role::where(['name' => 'Enterprise'])->first();

        if ($admin) {
            $admin->givePermissionTo($permission);
        }

        if ($enterprise) {
            $enterprise->givePermissionTo($permission);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permission = Permission::where(['name' => 'enterprise demo'])->first();
        $admin = Role::where(['name' => 'Admin'])->first();
        $enterprise = Role::where(['name' => 'Enterprise'])->first();

        if ($admin) {
            $admin->revokePermissionTo($permission);
        }

        if ($enterprise) {
            $enterprise->revokePermissionTo($permission);
        }

        $permission->delete();
    }
};
