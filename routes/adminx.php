<?php

use Illuminate\Support\Facades\Route;

/*
 * TODO: Admin routes without Backpack
 * */

Route::middleware(['auth', 'can:admin login'])->prefix('/adminx')->name('adminx.')->group(function () {

    Route::get('/', [App\Http\Controllers\Adminx\DashboardController::class, 'index'])->name('index');

    // TODO: Do not have proper permissions for all entities
    Route::prefix('/courses')->name('courses.')->middleware('permission:edit companies')->group(function () {
        Route::get('/', [App\Http\Controllers\Adminx\Entities\CourseController::class, 'index'])->name('index');
    });

    Route::prefix('/clinical-trials')->name('clinical-trials.')->middleware('permission:edit clinical trials')->group(function () {
        Route::get('/', [App\Http\Controllers\Adminx\Entities\ClinicalTrialsController::class, 'index'])->name('index');
    });

    Route::prefix('/care')->name('care.')->middleware('permission:edit companies')->group(function() {
        Route::get('/requests', [App\Http\Controllers\Adminx\Care\CareController::class, 'careRequests'])->name('care-requests');
        Route::get('/booking-requests', [App\Http\Controllers\Adminx\Care\BookableListingController::class, 'bookableListingRequests'])->name('listing-requests');
    });

    Route::prefix('/research')->name('research.')->middleware('permission:edit companies')->group(function() {
        Route::get('/requests', [App\Http\Controllers\Adminx\Research\ResearchController::class, 'researchRequests'])->name('research-requests');
    });

    Route::prefix('/edu')->name('edu.')->middleware('permission:edit companies')->group(function() {
        Route::get('/students', [App\Http\Controllers\Adminx\Edu\EduController::class, 'students'])->name('students');
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

    // USERS & AUTH
    Route::middleware('can:edit users')->prefix('/auth')->name('auth.')->group(function () {

        // Users
        Route::get('/users', [App\Http\Controllers\Adminx\Users\UsersController::class, 'index'])->name('users.index');
        Route::get('/users/{id}', [App\Http\Controllers\Adminx\Users\UsersController::class, 'show'])->name('users.show');

        // Roles and Permissions
        Route::get('/roles-permissions', [App\Http\Controllers\Adminx\Users\RolesAndPermissionsController::class, 'index'])->name('roles-permissions.index');
        Route::get('/roles-permissions/{id}', [App\Http\Controllers\Adminx\Users\RolesAndPermissionsController::class, 'show'])->name('roles-permissions.show');
    });

    // MISC TOOLS & PAGES - TEMP Middleware
    Route::middleware('can:edit companies')->name('misc.')->group(function() {
        Route::get('/feedback', [\App\Http\Controllers\Adminx\Users\UserActivityController::class, 'feedback'])->middleware('can:edit feedback')->name('feedback');
        Route::get('/search-logs', [\App\Http\Controllers\Adminx\Users\UserActivityController::class, 'searchLogs'])->middleware('can:edit feedback')->name('search-logs');
    });
});
