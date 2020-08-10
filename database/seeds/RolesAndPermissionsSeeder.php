<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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

        $permissions = array(
        	'edit companies',
        	'edit users',
        	'admin login',
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
          'edit listing requests',
          'import',
          'view job applications'
		);

		foreach($permissions as $permission){
			Permission::create(['name' => $permission]);
		}

        // Create admin role

		Role::create(['name' => 'Admin'])
			->givePermissionTo(Permission::all());

		// Create roles and assign permissions

        $roles = array(
        	'Subscriber' 	=> [],
        	'Premium' 		=> [],
        	'Editor' 		=> ['edit companies', 'admin login', 'edit investors', 'edit people'],
        	'Professional' 	=> [],
        	'Enterprise' 	=> [],
        );

        foreach($roles as $roleName => $permissions){
        	$role = Role::create(['name' => $roleName]);

        	if(count($permissions) > 0){
        		$role->givePermissionTo($permissions);
        	}
        }
    }
}
