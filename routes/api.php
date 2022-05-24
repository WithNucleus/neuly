<?php

use App\Http\Controllers\Api\CompaniesController;
use App\Http\Controllers\Api\ClinicaltrialsController;
use App\Http\Controllers\Api\EventsController;
use App\Http\Controllers\Api\InvestorsController;
use App\Http\Controllers\Api\JobsController;
use App\Http\Controllers\Api\PeopleController;
use App\Http\Controllers\Api\ResearchController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Index\SearchTemplateController;
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
Route::post('/search/templates', [SearchTemplateController::class, 'apiStore'])->name('search.templates.api.store');

Route::group([
    'middleware' => ['auth:api-users'],
], function () {
    Route::get('/user', [UserController::class, 'get']);
});

Route::group([
    'middleware' => ['api.auth:api'],
], function () {
    Route::get('/jobs', [JobsController::class, 'index']);
    Route::get('/events', [EventsController::class, 'index']);

    Route::get('/organizations', [CompaniesController::class, 'index']);
    Route::post('/organizations', [CompaniesController::class, 'create']);
    Route::post('/organizations/{id}', [CompaniesController::class, 'update']);

    Route::get('/people', [PeopleController::class, 'index']);
    Route::post('/people', [PeopleController::class, 'create']);
    Route::post('/people/{id}', [PeopleController::class, 'update']);

    Route::get('/investors', [InvestorsController::class, 'index']);
    Route::get('/research', [ResearchController::class, 'index']);
    Route::get('/clinical-trials', [ClinicaltrialsController::class, 'index']);

    Route::get('/search/suggestions', [SearchController::class, 'suggestions'])->name('search.suggestions');
});

