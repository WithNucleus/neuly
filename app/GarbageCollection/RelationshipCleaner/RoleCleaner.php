<?php

namespace App\GarbageCollection\RelationshipCleaner;

use App\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleCleaner
{
    private $roles = null;
    private $permissions = null;
    private $user = null;

    public function __construct()
    {
        $this->roles = Role::all()->pluck('id');
        $this->permissions = Permission::all()->pluck('id');
        $this->user = User::all()->pluck('id');
    }

    public function cleanRoleRelation()
    {
        $messages = [];

        $messages[] = $this->cleanPermissionRelation();
        $messages[] = $this->cleanUserRelation();

        return $messages;
    }

    public function cleanPermissionRelation()
    {
        $orphened = DB::table('role_has_permissions')
            ->select('role_id', 'permission_id')
            ->whereNotIn('role_id', $this->roles)
            ->orWhereNotIn('permission_id', $this->permissions)
            ->get();

        foreach($orphened as $entry)
        {
            DB::table('role_has_permissions')
                ->where('role_id','=', $entry->role_id)
                ->where('permission_id','=', $entry->permission_id)
                ->delete();
        }

        return "Cleaned ".$orphened->count()." orphened Relationships between Roles and Permissions.";
    }

    public function cleanUserRelation()
    {
        $orphened = DB::table('model_has_roles')
            ->select('role_id', 'model_id')
            ->where('model_type', '=', User::class)
            ->whereNotIn('model_id', $this->user)
            ->get();

        foreach($orphened as $entry)
        {
            DB::table('model_has_roles')
                ->where('role_id','=', $entry->role_id)
                ->where('model_id','=', $entry->model_id)
                ->where('model_type', '=', User::class)
                ->delete();
        }

        return "Cleaned ".$orphened->count()." orphened Relationships between Roles and Users.";
    }
}
