<?php

namespace App\GarbageCollection\RelationshipCleaner;

use App\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionCleaner
{
    private $permissions = null;
    private $user = null;

    public function __construct()
    {
        $this->permissions = Permission::all()->pluck('id');
        $this->user = User::all()->pluck('id');
    }

    public function cleanPermissionRelation()
    {
        $messages = [];
        $messages[] = $this->cleanUserRelation();

        return $messages;
    }

    public function cleanUserRelation()
    {
        $orphened = DB::table('model_has_permissions')
            ->select('permission_id', 'model_id')
            ->where('model_type', '=', User::class)
            ->whereNotIn('model_id', $this->user)
            ->get();

        foreach($orphened as $entry)
        {
            DB::table('model_has_permissions')
                ->where('permission_id','=', $entry->role_id)
                ->where('model_id','=', $entry->model_id)
                ->where('model_type', '=', User::class)
                ->delete();
        }

        return "Cleaned ".$orphened->count()." orphened Relationships between Permissions and Users.";
    }
}
