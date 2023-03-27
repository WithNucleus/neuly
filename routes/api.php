<?php

use App\Http\Controllers\Api\BookableListingsController;
use App\Http\Controllers\Api\ClinicaltrialsController;
use App\Http\Controllers\Api\CompaniesController;
use App\Http\Controllers\Api\EventsController;
use App\Http\Controllers\Api\InvestorsController;
use App\Http\Controllers\Api\JobsController;
use App\Http\Controllers\Api\MediaItemsController;
use App\Http\Controllers\Api\PeopleController;
use App\Http\Controllers\Api\ResearchController;
use App\Http\Controllers\Api\UserRolesController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Auth\OauthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/api/entities/list/{alias}', 'EntityDataController@getEntitiesListByAlias')->name('api.entities.list.byAlias');

Route::post('/feedback', 'FeedbackController@apiStore')->name('feedback.api.store');

Route::middleware('auth:api-users')->group(function () {
    Route::get('/user', [OauthController::class, 'getUser']);
});

Route::middleware('api.auth:api')->group(function () {
    Route::get('/users/{id}', [UsersController::class, 'show']);
    Route::post('/users', [UsersController::class, 'create']);
    Route::put('/users/{id}', [UsersController::class, 'update']);
    Route::post('/users/search', [UsersController::class, 'search']);

    Route::get('/roles', [UserRolesController::class, 'list']);
    Route::post('/roles/{userId}', [UserRolesController::class, 'assign']);
    Route::delete('/roles/{userId}', [UserRolesController::class, 'remove']);

    Route::get('/jobs', [JobsController::class, 'index']);
    Route::get('/jobs/{id}', [JobsController::class, 'show']);
    Route::post('/jobs', [JobsController::class, 'create']);
    Route::put('/jobs/{id}', [JobsController::class, 'update']);

    Route::get('/events', [EventsController::class, 'index']);
    Route::get('/events/past', [EventsController::class, 'past']);
    Route::get('/events/{id}', [EventsController::class, 'show']);
    Route::post('/events', [EventsController::class, 'create']);
    Route::put('/events/{id}', [EventsController::class, 'update']);

    Route::get('/organizations', [CompaniesController::class, 'index']);
    Route::get('/organizations/{id}', [CompaniesController::class, 'show']);
    Route::post('/organizations', [CompaniesController::class, 'create']);
    Route::put('/organizations/{id}', [CompaniesController::class, 'update']);

    Route::get('/people', [PeopleController::class, 'index']);
    Route::get('/people/{id}', [PeopleController::class, 'show']);
    Route::post('/people', [PeopleController::class, 'create']);
    Route::put('/people/{id}', [PeopleController::class, 'update']);

    Route::get('/investors', [InvestorsController::class, 'index']);
    Route::get('/investors/{id}', [InvestorsController::class, 'show']);
    Route::post('/investors', [InvestorsController::class, 'create']);
    Route::put('/investors/{id}', [InvestorsController::class, 'update']);

    Route::get('/research', [ResearchController::class, 'index']);
    Route::get('/research/{id}', [ResearchController::class, 'show']);
    Route::post('/research', [ResearchController::class, 'create']);
    Route::put('/research/{id}', [ResearchController::class, 'update']);

    Route::get('/clinical-trials', [ClinicaltrialsController::class, 'index']);
    Route::get('/clinical-trials/{id}', [ClinicaltrialsController::class, 'show']);
    Route::post('/clinical-trials', [ClinicaltrialsController::class, 'create']);
    Route::put('/clinical-trials/{id}', [ClinicaltrialsController::class, 'update']);

    Route::get('/media-items', [MediaItemsController::class, 'index']);
    Route::get('/media-items/{id}', [MediaItemsController::class, 'show']);
    Route::post('/media-items', [MediaItemsController::class, 'create']);
    Route::put('/media-items/{id}', [MediaItemsController::class, 'update']);

    Route::get('/bookable-listings', [BookableListingsController::class, 'index']);
//    Route::get('/bookable-listings/{id}', [BookableListingsController::class, 'show']);
//    Route::post('/bookable-listings', [BookableListingsController::class, 'create']);
//    Route::put('/bookable-listings/{id}', [BookableListingsController::class, 'update']);
});
