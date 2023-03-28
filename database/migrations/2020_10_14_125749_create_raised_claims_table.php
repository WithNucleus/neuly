<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

return new class extends Migration
{
    const PERMISSION_MANAGE_CLAIMS = 'edit person claims';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raised_claims', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('person_id');
            $table->foreign('person_id')
                ->on('people')
                ->references('id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->on('users')
                ->references('id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unique('user_id');
            $table->string('verification_token')->nullable(true);
            $table->unique('verification_token');
            $table->timestamps();
        });

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permission = Permission::create(['name' => self::PERMISSION_MANAGE_CLAIMS]);
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
        Schema::dropIfExists('raised_claims');

        $permission = Permission::where(['name' => self::PERMISSION_MANAGE_CLAIMS])->first();
        $role = Role::where(['name' => 'Admin'])->first();

        if ($permission && $role) {
            $role->revokePermissionTo($permission);
            $permission->delete();
        }

        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
    }
};
