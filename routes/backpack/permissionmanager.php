<?php

/*
|--------------------------------------------------------------------------
| Backpack\PermissionManager Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are
| handled by the Backpack\PermissionManager package.
|
*/

use App\Http\Controllers\Admin\PermissionCrudController;
use App\Http\Controllers\Admin\RoleCrudController;
use App\Http\Controllers\Admin\UserCrudController;
use Illuminate\Support\Facades\Route;

Route::prefix(config('backpack.base.route_prefix', 'admin'))->middleware(['web', backpack_middleware()])->group(function () {
    Route::crud('permission', PermissionCrudController::class);
    Route::crud('role', RoleCrudController::class);
    Route::crud('user', UserCrudController::class);
});
