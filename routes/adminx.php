<?php

use Illuminate\Support\Facades\Route;

/*
 * TODO: Admin routes without Backpack
 * */

Route::middleware('can:admin login')->prefix('/adminx')->name('adminx.')->group(function () {

    Route::get('/', [App\Http\Controllers\Adminx\DashboardController::class, 'index'])->name('index');

    // TODO: Do not have proper permissions for all entities
    Route::prefix('/courses')->name('courses.')->middleware('permission:edit companies')->group(function () {
        Route::get('/', [App\Http\Controllers\Adminx\Entities\CourseController::class, 'index'])->name('index');
    });

    // NAV TILES
    Route::prefix('/nav-tiles')->name('nav-tiles.')->middleware('permission:manage navigation tiles')->group(function () {
        Route::get('/', [\App\Http\Controllers\Adminx\NavigationTiles\NavigationTileController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Adminx\NavigationTiles\NavigationTileController::class, 'create'])->name('create');
        Route::post('/create', [\App\Http\Controllers\Adminx\NavigationTiles\NavigationTileController::class, 'store'])->name('store');
        Route::get('/{id}', [\App\Http\Controllers\Adminx\NavigationTiles\NavigationTileController::class, 'edit'])->name('edit');
        Route::post('/{id}', [\App\Http\Controllers\Adminx\NavigationTiles\NavigationTileController::class, 'update'])->name('update');
        Route::get('/clone/{id}', [\App\Http\Controllers\Adminx\NavigationTiles\NavigationTileController::class, 'clone'])->name('clone');
        Route::post('/delete/{id}', [\App\Http\Controllers\Adminx\NavigationTiles\NavigationTileController::class, 'delete'])->name('delete');

        Route::post('/reorder/{id}', [\App\Http\Controllers\Adminx\NavigationTiles\NavigationTileController::class, 'reorder'])->name('items.reorder');

        Route::post('/item/{id}', [\App\Http\Controllers\Adminx\NavigationTiles\NavigationTileItemController::class, 'store'])->name('items.store');
        Route::post('/update-item/{id}', [\App\Http\Controllers\Adminx\NavigationTiles\NavigationTileItemController::class, 'update'])->name('items.update');
        Route::post('/delete-item/{id}', [\App\Http\Controllers\Adminx\NavigationTiles\NavigationTileItemController::class, 'delete'])->name('items.delete');
    });

    // IMPORT
    Route::middleware('can:import')->prefix('/import')->name('import.')->group(function () {

        // Clinical Trials
        Route::prefix('/clinical-trials')->name('clinical-trials.')->group(function() {
            Route::get('/', [App\Http\Controllers\Adminx\Import\ClinicalTrialsController::class, 'index'])->name('index');
            Route::get('/start', [App\Http\Controllers\Adminx\Import\ClinicalTrialsController::class, 'import'])->name('import');
        });

        // Courses
        Route::prefix('/courses')->name('courses.')->group(function() {
            Route::get('/', [App\Http\Controllers\Adminx\Import\CourseController::class, 'index'])->name('index');
            Route::get('/results', [App\Http\Controllers\Adminx\Import\CourseController::class, 'results'])->name('results');
            Route::get('/results/{id}', [App\Http\Controllers\Adminx\Import\CourseController::class, 'show'])->name('show');
        });
    });
});
