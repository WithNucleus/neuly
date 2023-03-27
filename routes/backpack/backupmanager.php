<?php

use App\Http\Controllers\App;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Backpack\BackupManager Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are
| handled by the Backpack\BackupManager package.
|
*/

Route::prefix(config('backpack.base.route_prefix', 'admin'))->middleware('web', config('backpack.base.middleware_key', 'admin'))->group(function () {
    Route::get('backup', [App\Http\Controllers\Admin\BackupController::class, 'index'])->name('backup.index');
    Route::put('backup/create', [App\Http\Controllers\Admin\BackupController::class, 'create'])->name('backup.store');
    Route::put('backup/database/create', [App\Http\Controllers\Admin\BackupController::class, 'createDatabase'])->name('backup.database.store');
    Route::get('backup/download/{file_name?}', [App\Http\Controllers\Admin\BackupController::class, 'download'])->name('backup.download');
    Route::delete('backup/delete/{file_name?}', [App\Http\Controllers\Admin\BackupController::class, 'delete'])->where('file_name', '(.*)')->name('backup.destroy');
});
