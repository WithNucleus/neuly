<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class AddNucleusToolsPermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permission = Permission::create(['name' => 'nucleus tools']);
        $role = Role::where(['name' => 'Admin'])->first();

        if ($role) {
            $role->givePermissionTo($permission);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $permission = Permission::where(['name' => 'nucleus tools'])->first();
        $role = Role::where(['name' => 'Admin'])->first();

        if ($permission && $role) {
            $role->revokePermissionTo($permission);
            $permission->delete();
        }

        app()[PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
