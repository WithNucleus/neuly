<?php

use App\Http\Controllers\App;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Backpack\LogManager Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are
| handled by the Backpack\LogManager package.
|
*/

Route::middleware('web', config('backpack.base.middleware_key', 'admin'))->prefix(config('backpack.base.route_prefix', 'admin'))->group(function () {
    Route::get('log', [App\Http\Controllers\Admin\LogController::class, 'index'])->name('log.index');
    Route::get('log/preview/{file_name}', [App\Http\Controllers\Admin\LogController::class, 'preview'])->name('log.show');
    Route::get('log/download/{file_name}', [App\Http\Controllers\Admin\LogController::class, 'download'])->name('log.download');
    Route::delete('log/delete/{file_name}', [App\Http\Controllers\Admin\LogController::class, 'delete'])->name('log.destroy');
});
