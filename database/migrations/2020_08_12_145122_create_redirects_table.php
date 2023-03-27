<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class CreateRedirectsTable extends Migration
{
    const PERMISSION_MANAGE_REDIRECTS = 'manage redirects';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redirects', function (Blueprint $table) {
            $table->id();
            $table->string('old_slug');
            $table->unsignedBigInteger('redirectable_id');
            $table->string('redirectable_type');
            $table->timestamps();
        });

        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permission = Permission::create(['name' => self::PERMISSION_MANAGE_REDIRECTS]);
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
        Schema::dropIfExists('redirects');

        $permission = Permission::where(['name' => self::PERMISSION_MANAGE_REDIRECTS])->first();
        $role = Role::where(['name' => 'Admin'])->first();

        if ($permission && $role) {
            $role->revokePermissionTo($permission);
            $permission->delete();
        }

        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
