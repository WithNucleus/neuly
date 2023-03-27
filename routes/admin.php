<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('/admin')->namespace('Admin')->name('admin.')->group(function () {
    Route::middleware('role:Admin')->group(function () {
        // Related Entities
        Route::get('/person/{id}/company', 'PersonCompanyController@index');
        Route::post('/person/{id}/company', 'PersonCompanyController@add');

        Route::get('/investor/{id}/person', 'InvestorPersonController@index');
        Route::post('/investor/{id}/person', 'InvestorPersonController@add');
        Route::get('/investor/{investor_id}/person/{person_id}/remove', 'InvestorPersonController@remove')->name('investorperson.remove');

        Route::get('/person/{id}/investor', 'PersonInvestorController@index');
        Route::post('/person/{id}/investor', 'PersonInvestorController@add');

        // Entity Merge
        Route::prefix('entity-merge')->group(function () {
            Route::get('/', 'EntityMergeController@index')
                ->name('entityMerge');
            Route::get('/get-list', 'EntityMergeController@getEntityListJson')
                ->name('entityMerge.getEntityListJson');
            Route::get('/get-entity-form', 'EntityMergeController@getEntityForm')
                ->name('entityMerge.getEntityForm');
            Route::post('/merge', 'EntityMergeController@merge')
                ->name('entityMerge.merge');
        });
    });

    Route::prefix('/company/{company_id}')->namespace('Company')->name('company.')->middleware('permission:edit companies')->group(function () {
        Route::get('/person', 'PersonController@index')->name('person.index');
        Route::post('/person', 'PersonController@store')->name('person.store');
        Route::get('/person/{person_id}', 'PersonController@remove')->name('person.remove');

        Route::get('/parent', 'ParentController@index')->name('parent.index');
        Route::post('/parent', 'ParentController@store')->name('parent.store');
        Route::delete('/parent/{parent_id}', 'ParentController@remove')->name('parent.remove');

        Route::get('/subsidiary', 'SubsidiaryController@index')->name('subsidiary.index');
        Route::post('/subsidiary', 'SubsidiaryController@store')->name('subsidiary.store');
        Route::delete('/subsidiary/{child_id}', 'SubsidiaryController@remove')->name('subsidiary.remove');
    });

    // Data Feed
    Route::middleware('permission:import')->group(function () {
        Route::crud('datafeed', 'DataFeedCrudController');
        Route::prefix('/datafeed')->name('datafeed.')->group(function () {
            Route::get('/{id}/get', 'DataFeedCrudController@getFeedItems')->name('get');
        });

        // Media Items
        Route::crud('media-item', 'MediaItemCrudController');
        Route::get('/media-dashboard', 'DataFeeds\DashboardController@index')->name('media-dashboard');
        Route::post('/media-dashboard/update/{id}', 'DataFeeds\DashboardController@update')->name('media-dashboard.update');

        // Metrics
        Route::crud('metric', 'MetricCrudController');
        Route::get('/metrics/charts', 'Metrics\DashboardController@charts')->name('metrics.charts');
        Route::get('/metrics/tiles', 'Metrics\DashboardController@tiles')->name('metrics.tiles');
        Route::get('/metrics/tiles/details', 'Metrics\DashboardController@tileDetails')->name('metrics.tiles.details');

        // Courses
        Route::crud('course', 'CourseCrudController');
    });

    Route::prefix('/nav-tiles')->name('nav-tiles.')->namespace('NavigationTiles')->middleware('permission:manage navigation tiles')->group(function () {
        Route::get('/', 'NavigationTileController@index')->name('index');
        Route::get('/create', 'NavigationTileController@create')->name('create');
        Route::post('/create', 'NavigationTileController@store')->name('store');
        Route::get('/{id}', 'NavigationTileController@edit')->name('edit');
        Route::post('/{id}', 'NavigationTileController@update')->name('update');
        Route::get('/clone/{id}', 'NavigationTileController@clone')->name('clone');
        Route::post('/delete/{id}', 'NavigationTileController@delete')->name('delete');

        Route::post('/reorder/{id}', 'NavigationTileController@reorder')->name('items.reorder');

        Route::post('/item/{id}', 'NavigationTileItemController@store')->name('items.store');
        Route::post('/update-item/{id}', 'NavigationTileItemController@update')->name('items.update');
        Route::post('/delete-item/{id}', 'NavigationTileItemController@delete')->name('items.delete');
    });
});

Route::get('/nav-tiles/{slug}.js', 'Admin\NavigationTiles\NavigationTileController@script')->name('nav-tiles.script');
Route::get('/nav-tiles/{slug}.css', 'Admin\NavigationTiles\NavigationTileController@style')->name('nav-tiles.style');

//TODO update route's names to match 'admin.' pattern and move to common admin group
Route::middleware('permission:import')->prefix('/admin/import')->namespace('Admin\Import')->name('import.')->group(function () {
    // Import Clinical Trials
    Route::get('/clinicaltrials', 'ClinicalTrialController@importClinicaltrials')
        ->name('clinicaltrials');
    Route::post('/clinicaltrials', 'ClinicalTrialController@processClinicaltrials')
        ->name('clinicaltrials.process');

    //Import Settings
    Route::get('/settings', 'SettingsController@index')
        ->name('settings.index');
    Route::post('/settings', 'SettingsController@update')
        ->name('settings.update');

    // Import Research
    Route::get('/research', 'ResearchController@start')
        ->name('research');
    Route::post('/research', 'ResearchController@search')
        ->name('research.process');
    Route::post('/research/save', 'ResearchController@import')
        ->name('research.save');

    // Import Results Show
    Route::get('/results/{id}', 'ResultsController@showResults')
        ->name('results');

    //Fix Import Failure
    Route::post('/failures/{id}/fix', 'FailuresController@fix')
        ->name('failures.fix');
    Route::post('/failures/{id}/delete', 'FailuresController@delete')
        ->name('failures.delete');

    //Import Failures List
    Route::get('/{id}/failures', 'ResultsController@showFailures')
        ->name('failures');
    Route::get('/{id}/failures/{type}', 'FailuresController@showByType')
        ->name('failures.showByType');

    Route::prefix('/related-entities')->name('related-entities.')->group(function () {
        Route::get('/', 'RelatedEntitiesController@index')->name('index');

        Route::prefix('/locations')->namespace('RelatedEntities')->name('locations.')->group(function () {
            Route::get('/', 'LocationsController@index')->name('index');
            Route::post('/import', 'LocationsController@import')->name('import');
            Route::get('/results/{id}', 'LocationsController@results')->name('results');
            Route::get('/failures/{id}', 'LocationsController@failures')->name('failures');
        });

        Route::prefix('/people-organization')->namespace('RelatedEntities')->name('people-organization.')->group(function () {
            Route::get('/', 'PeopleOrganizationController@index')->name('index');
            Route::post('/import', 'PeopleOrganizationController@import')->name('import');
            Route::get('/results/{id}', 'PeopleOrganizationController@results')->name('results');
            Route::get('/failures/{id}', 'PeopleOrganizationController@failures')->name('failures');
        });
    });

    Route::prefix('/batch-images-upload')->name('batch-images-upload.')->group(function () {
        Route::get('/', 'BatchImagesUploadController@index')->name('index');
        Route::post('/import', 'BatchImagesUploadController@import')->name('import');
        Route::get('/results/{id}', 'BatchImagesUploadController@results')->name('results');
        Route::get('/failures/{id}', 'BatchImagesUploadController@failures')->name('failures');
    });
});

//TODO update route's names and middleware to match 'admin' pattern and move to common admin group
//TODO check if it possible to move methods tos Admin namespace and controller
Route::middleware('auth')->prefix('/admin')->group(function () {
    //Job Application Files
    Route::get('/jobapps/{id}/resume', 'Index\JobApplicationController@getResume')->name('jobsapp.resume');
    Route::get('/jobapps/{id}/coverletter', 'Index\JobApplicationController@getCoverLetter')->name('jobsapp.coverletter');
});
