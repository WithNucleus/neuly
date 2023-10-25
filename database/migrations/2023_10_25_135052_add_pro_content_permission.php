<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    const PERMISSION = 'view pro content';

    public function up()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        \Spatie\Permission\Models\Permission::create(['name' => self::PERMISSION]);

        $roles = \App\Models\Role::whereIn('name', ['Enterprise', 'PI Pro', 'Admin', 'Editor'])->get();
        foreach($roles as $role) {
            $role->givePermissionTo(self::PERMISSION);
        }
    }

    public function down()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        \Spatie\Permission\Models\Permission::where('name', self::PERMISSION)->delete();
    }
};
