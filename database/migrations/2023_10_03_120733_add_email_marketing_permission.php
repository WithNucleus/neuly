<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    const PERMISSION = 'email marketing';

    public function up()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        \Spatie\Permission\Models\Permission::create(['name' => self::PERMISSION]);
        $role = \App\Models\Role::where('name', 'Admin')->first();
        $role->givePermissionTo(self::PERMISSION);
    }

    public function down()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        \Spatie\Permission\Models\Permission::where('name', self::PERMISSION)->delete();
    }
};
