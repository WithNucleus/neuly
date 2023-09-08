<?php

namespace App\Http\Controllers\Adminx\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsController extends Controller
{
    public function __construct() {
        View::share('currentRoute', 'auth');
    }

    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('adminx.auth.roles-permissions.index');
    }

    public function show($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $role = Role::findOrFail($id);
        return view('adminx.auth.roles-permissions.show', [
            'role' => $role
        ]);
    }
}
