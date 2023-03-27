<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    private $newPermissions = [
        'manage navigation tiles',
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navigation_tiles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('domain');
            $table->string('menu_bg');
            $table->string('menu_link_color');
            $table->string('menu_link_hover_color');
            $table->string('button_bg');
            $table->string('title_color');
            $table->string('title_border_color');
            $table->string('badge_bg');
            $table->string('badge_color');
            $table->string('image')->nullable();
            $table->timestamps();
        });

        $permissions = [];

        foreach ($this->newPermissions as $permission) {
            $permissions[] = Permission::updateOrCreate(['name' => $permission]);
        }

        $adminRole = Role::where('name', 'Admin')->first();

        if ($adminRole !== null) {
            $adminRole->givePermissionTo($permissions);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Permission::whereIn('name', $this->newPermissions)->delete();

        $adminRole = Role::where('name', 'Admin')->first();

        if ($adminRole !== null) {
            $adminRole->revokePermissionTo($this->newPermissions);
        }

        Schema::dropIfExists('navigation_tiles');
    }
};
