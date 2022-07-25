<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Requests\Api\UserRoleRequest;
use Spatie\Permission\Models\Role;

class UserRolesController
{
    public function list()
    {
        $roles = Role::all()->pluck('name');

        return response()->json($roles);
    }

    public function assign(UserRoleRequest $request, $userId)
    {
        $user = User::findOrFail($userId);
        $role = $request->input('role');

        $user->assignRole($role);

        return response()->json(['message' => 'Role assigned successfully.']);
    }

    public function remove(UserRoleRequest $request, $userId)
    {
        $user = User::findOrFail($userId);
        $role = $request->input('role');

        $user->removeRole($role);

        return response()->json(['message' => 'Role removed successfully.']);
    }
}
