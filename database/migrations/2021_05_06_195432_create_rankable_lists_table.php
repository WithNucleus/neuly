<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class CreateRankableListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ranked_lists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permission = Permission::create(['name' => 'manage ranked lists']);
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
        Schema::dropIfExists('ranked_lists');

        $permission = Permission::where(['name' => 'manage ranked lists'])->first();
        $role = Role::where(['name' => 'Admin'])->first();

        if ($permission && $role) {
            $role->revokePermissionTo($permission);
            $permission->delete();
        }

        app()[PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
