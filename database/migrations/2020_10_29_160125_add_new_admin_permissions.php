<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class AddNewAdminPermissions extends Migration
{

    private $newPermissions = [
        'manage insight requests',
        'manage job reports',
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
        Permission::whereIn('name' , $this->newPermissions)->delete();

        $adminRole = Role::where('name', 'Admin')->first();

        if ($adminRole !== null) {
            $adminRole->revokePermissionTo($this->newPermissions);
        }
    }
}
