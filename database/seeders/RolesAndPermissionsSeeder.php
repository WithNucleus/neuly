<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions

        $permissions = [
            'admin login',
            'edit companies',
            'edit users',
            'edit focus categories',
            'view backups',
            'view logs',
            'edit content',
            'edit investors',
            'edit people',
            'edit locations',
            'edit research',
            'edit jobs',
            'edit events',
            'edit event types',
            'edit news articles',
            'edit clinical trials',
            'import',
            'view job applications',
            'manage redirects',
            'edit feedback',
            'manage listing requests',
            'manage entity merge',
            'manage insight requests',
            'manage job reports',
            'edit person claims',
            'manage ranked lists',
            'manage navigation tiles',
            'enterprise demo',
            'nucleus tools',
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission]);
        }

        // Create admin role

        Role::create(['name' => 'Admin'])
            ->givePermissionTo(Permission::all());

        // Create roles and assign permissions

        $roles = [
            'Subscriber' => [],
            'Premium' => [],
            'Editor' => ['edit companies', 'admin login', 'edit investors', 'edit people', 'edit events', 'enterprise demo'],
            'Professional' => [],
            'Enterprise' => [],
            'Team owner' => [],
            'Team member' => [],
        ];

        foreach ($roles as $roleName => $permissions) {
            $role = Role::create(['name' => $roleName]);

            if (count($permissions) > 0) {
                $role->givePermissionTo($permissions);
            }
        }
    }
}
