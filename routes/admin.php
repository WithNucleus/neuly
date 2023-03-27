<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Index;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('/admin')->name('admin.')->group(function () {
    Route::middleware('role:Admin')->group(function () {
        // Related Entities
        Route::get('/person/{id}/company', [Admin\PersonCompanyController::class, 'index']);
        Route::post('/person/{id}/company', [Admin\PersonCompanyController::class, 'add']);

        Route::get('/investor/{id}/person', [Admin\InvestorPersonController::class, 'index']);
        Route::post('/investor/{id}/person', [Admin\InvestorPersonController::class, 'add']);
        Route::get('/investor/{investor_id}/person/{person_id}/remove', [Admin\InvestorPersonController::class, 'remove'])->name('investorperson.remove');

        Route::get('/person/{id}/investor', [Admin\PersonInvestorController::class, 'index']);
        Route::post('/person/{id}/investor', [Admin\PersonInvestorController::class, 'add']);

        // Entity Merge
        Route::prefix('entity-merge')->group(function () {
            Route::get('/', [Admin\EntityMergeController::class, 'index'])
                ->name('entityMerge');
            Route::get('/get-list', [Admin\EntityMergeController::class, 'getEntityListJson'])
                ->name('entityMerge.getEntityListJson');
            Route::get('/get-entity-form', [Admin\EntityMergeController::class, 'getEntityForm'])
                ->name('entityMerge.getEntityForm');
            Route::post('/merge', [Admin\EntityMergeController::class, 'merge'])
                ->name('entityMerge.merge');
        });
    });

    Route::prefix('/company/{company_id}')->name('company.')->middleware('permission:edit companies')->group(function () {
        Route::get('/person', [Admin\Company\PersonController::class, 'index'])->name('person.index');
        Route::post('/person', [Admin\Company\PersonController::class, 'store'])->name('person.store');
        Route::get('/person/{person_id}', [Admin\Company\PersonController::class, 'remove'])->name('person.remove');

        Route::get('/parent', [Admin\Company\ParentController::class, 'index'])->name('parent.index');
        Route::post('/parent', [Admin\Company\ParentController::class, 'store'])->name('parent.store');
        Route::delete('/parent/{parent_id}', [Admin\Company\ParentController::class, 'remove'])->name('parent.remove');

        Route::get('/subsidiary', [Admin\Company\SubsidiaryController::class, 'index'])->name('subsidiary.index');
        Route::post('/subsidiary', [Admin\Company\SubsidiaryController::class, 'store'])->name('subsidiary.store');
        Route::delete('/subsidiary/{child_id}', [Admin\Company\SubsidiaryController::class, 'remove'])->name('subsidiary.remove');
    });

    // Data Feed
    Route::middleware('permission:import')->group(function () {
        Route::crud('datafeed', 'DataFeedCrudController');
        Route::prefix('/datafeed')->name('datafeed.')->group(function () {
            Route::get('/{id}/get', [Admin\DataFeedCrudController::class, 'getFeedItems'])->name('get');
        });

        // Media Items
        Route::crud('media-item', 'MediaItemCrudController');
        Route::get('/media-dashboard', [Admin\DataFeeds\DashboardController::class, 'index'])->name('media-dashboard');
        Route::post('/media-dashboard/update/{id}', [Admin\DataFeeds\DashboardController::class, 'update'])->name('media-dashboard.update');

        // Metrics
        Route::crud('metric', 'MetricCrudController');
        Route::get('/metrics/charts', [Admin\Metrics\DashboardController::class, 'charts'])->name('metrics.charts');
        Route::get('/metrics/tiles', [Admin\Metrics\DashboardController::class, 'tiles'])->name('metrics.tiles');
        Route::get('/metrics/tiles/details', [Admin\Metrics\DashboardController::class, 'tileDetails'])->name('metrics.tiles.details');

        // Courses
        Route::crud('course', 'CourseCrudController');
    });

    Route::prefix('/nav-tiles')->name('nav-tiles.')->middleware('permission:manage navigation tiles')->group(function () {
        Route::get('/', [Admin\NavigationTiles\NavigationTileController::class, 'index'])->name('index');
        Route::get('/create', [Admin\NavigationTiles\NavigationTileController::class, 'create'])->name('create');
        Route::post('/create', [Admin\NavigationTiles\NavigationTileController::class, 'store'])->name('store');
        Route::get('/{id}', [Admin\NavigationTiles\NavigationTileController::class, 'edit'])->name('edit');
        Route::post('/{id}', [Admin\NavigationTiles\NavigationTileController::class, 'update'])->name('update');
        Route::get('/clone/{id}', [Admin\NavigationTiles\NavigationTileController::class, 'clone'])->name('clone');
        Route::post('/delete/{id}', [Admin\NavigationTiles\NavigationTileController::class, 'delete'])->name('delete');

        Route::post('/reorder/{id}', [Admin\NavigationTiles\NavigationTileController::class, 'reorder'])->name('items.reorder');

        Route::post('/item/{id}', [Admin\NavigationTiles\NavigationTileItemController::class, 'store'])->name('items.store');
        Route::post('/update-item/{id}', [Admin\NavigationTiles\NavigationTileItemController::class, 'update'])->name('items.update');
        Route::post('/delete-item/{id}', [Admin\NavigationTiles\NavigationTileItemController::class, 'delete'])->name('items.delete');
    });
});

Route::get('/nav-tiles/{slug}.js', [Admin\NavigationTiles\NavigationTileController::class, 'script'])->name('nav-tiles.script');
Route::get('/nav-tiles/{slug}.css', [Admin\NavigationTiles\NavigationTileController::class, 'style'])->name('nav-tiles.style');

//TODO update route's names to match 'admin.' pattern and move to common admin group
Route::middleware('permission:import')->prefix('/admin/import')->name('import.')->group(function () {
    // Import Clinical Trials
    Route::get('/clinicaltrials', [Admin\Import\ClinicalTrialController::class, 'importClinicaltrials'])
        ->name('clinicaltrials');
    Route::post('/clinicaltrials', [Admin\Import\ClinicalTrialController::class, 'processClinicaltrials'])
        ->name('clinicaltrials.process');

    //Import Settings
    Route::get('/settings', [Admin\Import\SettingsController::class, 'index'])
        ->name('settings.index');
    Route::post('/settings', [Admin\Import\SettingsController::class, 'update'])
        ->name('settings.update');

    // Import Research
    Route::get('/research', [Admin\Import\ResearchController::class, 'start'])
        ->name('research');
    Route::post('/research', [Admin\Import\ResearchController::class, 'search'])
        ->name('research.process');
    Route::post('/research/save', [Admin\Import\ResearchController::class, 'import'])
        ->name('research.save');

    // Import Results Show
    Route::get('/results/{id}', [Admin\Import\ResultsController::class, 'showResults'])
        ->name('results');

    //Fix Import Failure
    Route::post('/failures/{id}/fix', [Admin\Import\FailuresController::class, 'fix'])
        ->name('failures.fix');
    Route::post('/failures/{id}/delete', [Admin\Import\FailuresController::class, 'delete'])
        ->name('failures.delete');

    //Import Failures List
    Route::get('/{id}/failures', [Admin\Import\ResultsController::class, 'showFailures'])
        ->name('failures');
    Route::get('/{id}/failures/{type}', [Admin\Import\FailuresController::class, 'showByType'])
        ->name('failures.showByType');

    Route::prefix('/related-entities')->name('related-entities.')->group(function () {
        Route::get('/', [Admin\Import\RelatedEntitiesController::class, 'index'])->name('index');

        Route::prefix('/locations')->name('locations.')->group(function () {
            Route::get('/', [Admin\Import\RelatedEntities\LocationsController::class, 'index'])->name('index');
            Route::post('/import', [Admin\Import\RelatedEntities\LocationsController::class, 'import'])->name('import');
            Route::get('/results/{id}', [Admin\Import\RelatedEntities\LocationsController::class, 'results'])->name('results');
            Route::get('/failures/{id}', [Admin\Import\RelatedEntities\LocationsController::class, 'failures'])->name('failures');
        });

        Route::prefix('/people-organization')->name('people-organization.')->group(function () {
            Route::get('/', [Admin\Import\RelatedEntities\PeopleOrganizationController::class, 'index'])->name('index');
            Route::post('/import', [Admin\Import\RelatedEntities\PeopleOrganizationController::class, 'import'])->name('import');
            Route::get('/results/{id}', [Admin\Import\RelatedEntities\PeopleOrganizationController::class, 'results'])->name('results');
            Route::get('/failures/{id}', [Admin\Import\RelatedEntities\PeopleOrganizationController::class, 'failures'])->name('failures');
        });
    });

    Route::prefix('/batch-images-upload')->name('batch-images-upload.')->group(function () {
        Route::get('/', [Admin\Import\BatchImagesUploadController::class, 'index'])->name('index');
        Route::post('/import', [Admin\Import\BatchImagesUploadController::class, 'import'])->name('import');
        Route::get('/results/{id}', [Admin\Import\BatchImagesUploadController::class, 'results'])->name('results');
        Route::get('/failures/{id}', [Admin\Import\BatchImagesUploadController::class, 'failures'])->name('failures');
    });
});

//TODO update route's names and middleware to match 'admin' pattern and move to common admin group
//TODO check if it possible to move methods tos Admin namespace and controller
Route::middleware('auth')->prefix('/admin')->group(function () {
    //Job Application Files
    Route::get('/jobapps/{id}/resume', [Index\JobApplicationController::class, 'getResume'])->name('jobsapp.resume');
    Route::get('/jobapps/{id}/coverletter', [Index\JobApplicationController::class, 'getCoverLetter'])->name('jobsapp.coverletter');
});
