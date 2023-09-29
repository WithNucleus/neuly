<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('/admin')->name('admin.')->group(function () {
    Route::middleware('role:Admin')->group(function () {
        // Choices.js
        Route::get('/choices/focus.json', [App\Http\Controllers\Admin\ChoicesController::class, 'focusDrugs'])->name('choices.focus');

        // Related Entities
        Route::get('/person/{id}/company', [App\Http\Controllers\Admin\PersonCompanyController::class, 'index']);
        Route::post('/person/{id}/company', [App\Http\Controllers\Admin\PersonCompanyController::class, 'add']);

        Route::get('/investor/{id}/person', [App\Http\Controllers\Admin\InvestorPersonController::class, 'index']);
        Route::post('/investor/{id}/person', [App\Http\Controllers\Admin\InvestorPersonController::class, 'add']);
        Route::get('/investor/{investor_id}/person/{person_id}/remove', [App\Http\Controllers\Admin\InvestorPersonController::class, 'remove'])->name('investorperson.remove');

        Route::get('/person/{id}/investor', [App\Http\Controllers\Admin\PersonInvestorController::class, 'index']);
        Route::post('/person/{id}/investor', [App\Http\Controllers\Admin\PersonInvestorController::class, 'add']);

        // Entity Merge
        Route::prefix('entity-merge')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\EntityMergeController::class, 'index'])
                ->name('entityMerge');
            Route::get('/get-list', [App\Http\Controllers\Admin\EntityMergeController::class, 'getEntityListJson'])
                ->name('entityMerge.getEntityListJson');
            Route::get('/get-entity-form', [App\Http\Controllers\Admin\EntityMergeController::class, 'getEntityForm'])
                ->name('entityMerge.getEntityForm');
            Route::post('/merge', [App\Http\Controllers\Admin\EntityMergeController::class, 'merge'])
                ->name('entityMerge.merge');
        });
    });

    Route::prefix('/company/{company_id}')->name('company.')->middleware('permission:edit companies')->group(function () {
        Route::get('/person', [App\Http\Controllers\Admin\Company\PersonController::class, 'index'])->name('person.index');
        Route::post('/person', [App\Http\Controllers\Admin\Company\PersonController::class, 'store'])->name('person.store');
        Route::get('/person/{person_id}', [App\Http\Controllers\Admin\Company\PersonController::class, 'remove'])->name('person.remove');

        Route::get('/parent', [App\Http\Controllers\Admin\Company\ParentController::class, 'index'])->name('parent.index');
        Route::post('/parent', [App\Http\Controllers\Admin\Company\ParentController::class, 'store'])->name('parent.store');
        Route::delete('/parent/{parent_id}', [App\Http\Controllers\Admin\Company\ParentController::class, 'remove'])->name('parent.remove');

        Route::get('/subsidiary', [App\Http\Controllers\Admin\Company\SubsidiaryController::class, 'index'])->name('subsidiary.index');
        Route::post('/subsidiary', [App\Http\Controllers\Admin\Company\SubsidiaryController::class, 'store'])->name('subsidiary.store');
        Route::delete('/subsidiary/{child_id}', [App\Http\Controllers\Admin\Company\SubsidiaryController::class, 'remove'])->name('subsidiary.remove');
    });

    // Data Feed
    Route::middleware('permission:import')->group(function () {
        Route::prefix('/datafeed')->name('datafeed.')->group(function () {
            Route::get('/{id}/get', [App\Http\Controllers\Admin\DataFeedCrudController::class, 'getFeedItems'])->name('get');
        });

        // Media Items
        Route::get('/media-dashboard', [App\Http\Controllers\Admin\DataFeeds\DashboardController::class, 'index'])->name('media-dashboard');
        Route::post('/media-dashboard/update/{id}', [App\Http\Controllers\Admin\DataFeeds\DashboardController::class, 'update'])->name('media-dashboard.update');

        // Metrics
        Route::get('/metrics/charts', [App\Http\Controllers\Admin\Metrics\DashboardController::class, 'charts'])->name('metrics.charts');
        Route::get('/metrics/tiles', [App\Http\Controllers\Admin\Metrics\DashboardController::class, 'tiles'])->name('metrics.tiles');
        Route::get('/metrics/tiles/details', [App\Http\Controllers\Admin\Metrics\DashboardController::class, 'tileDetails'])->name('metrics.tiles.details');
    });
});

Route::get('/nav-tiles/{slug}.js', [\App\Http\Controllers\Adminx\NavigationTiles\NavigationTileController::class, 'script'])->name('nav-tiles.script');
Route::get('/nav-tiles/{slug}.css', [\App\Http\Controllers\Adminx\NavigationTiles\NavigationTileController::class, 'style'])->name('nav-tiles.style');

//TODO update route's names to match 'admin.' pattern and move to common admin group
Route::middleware('permission:import')->prefix('/admin/import')->name('import.')->group(function () {
    // Import Clinical Trials
    Route::get('/clinicaltrials', [App\Http\Controllers\Admin\Import\ClinicalTrialController::class, 'importClinicaltrials'])
        ->name('clinicaltrials');
    Route::post('/clinicaltrials', [App\Http\Controllers\Admin\Import\ClinicalTrialController::class, 'processClinicaltrials'])
        ->name('clinicaltrials.process');

    //Import Settings
    Route::get('/settings', [App\Http\Controllers\Admin\Import\SettingsController::class, 'index'])
        ->name('settings.index');
    Route::post('/settings', [App\Http\Controllers\Admin\Import\SettingsController::class, 'update'])
        ->name('settings.update');

    // Import Research
    Route::get('/research', [App\Http\Controllers\Admin\Import\ResearchController::class, 'start'])
        ->name('research');
    Route::post('/research', [App\Http\Controllers\Admin\Import\ResearchController::class, 'search'])
        ->name('research.process');
    Route::post('/research/save', [App\Http\Controllers\Admin\Import\ResearchController::class, 'import'])
        ->name('research.save');

    // Import Results Show
    Route::get('/results/{id}', [App\Http\Controllers\Admin\Import\ResultsController::class, 'showResults'])
        ->name('results');

    //Fix Import Failure
    Route::post('/failures/{id}/fix', [App\Http\Controllers\Admin\Import\FailuresController::class, 'fix'])
        ->name('failures.fix');
    Route::post('/failures/{id}/delete', [App\Http\Controllers\Admin\Import\FailuresController::class, 'delete'])
        ->name('failures.delete');

    //Import Failures List
    Route::get('/{id}/failures', [App\Http\Controllers\Admin\Import\ResultsController::class, 'showFailures'])
        ->name('failures');
    Route::get('/{id}/failures/{type}', [App\Http\Controllers\Admin\Import\FailuresController::class, 'showByType'])
        ->name('failures.showByType');

    Route::prefix('/related-entities')->name('related-entities.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\Import\RelatedEntitiesController::class, 'index'])->name('index');

        Route::prefix('/locations')->name('locations.')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\Import\RelatedEntities\LocationsController::class, 'index'])->name('index');
            Route::post('/import', [App\Http\Controllers\Admin\Import\RelatedEntities\LocationsController::class, 'import'])->name('import');
            Route::get('/results/{id}', [App\Http\Controllers\Admin\Import\RelatedEntities\LocationsController::class, 'results'])->name('results');
            Route::get('/failures/{id}', [App\Http\Controllers\Admin\Import\RelatedEntities\LocationsController::class, 'failures'])->name('failures');
        });

        Route::prefix('/people-organization')->name('people-organization.')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\Import\RelatedEntities\PeopleOrganizationController::class, 'index'])->name('index');
            Route::post('/import', [App\Http\Controllers\Admin\Import\RelatedEntities\PeopleOrganizationController::class, 'import'])->name('import');
            Route::get('/results/{id}', [App\Http\Controllers\Admin\Import\RelatedEntities\PeopleOrganizationController::class, 'results'])->name('results');
            Route::get('/failures/{id}', [App\Http\Controllers\Admin\Import\RelatedEntities\PeopleOrganizationController::class, 'failures'])->name('failures');
        });
    });

    Route::prefix('/batch-images-upload')->name('batch-images-upload.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\Import\BatchImagesUploadController::class, 'index'])->name('index');
        Route::post('/import', [App\Http\Controllers\Admin\Import\BatchImagesUploadController::class, 'import'])->name('import');
        Route::get('/results/{id}', [App\Http\Controllers\Admin\Import\BatchImagesUploadController::class, 'results'])->name('results');
        Route::get('/failures/{id}', [App\Http\Controllers\Admin\Import\BatchImagesUploadController::class, 'failures'])->name('failures');
    });
});

//TODO update route's names and middleware to match 'admin' pattern and move to common admin group
//TODO check if it possible to move methods tos Admin namespace and controller
Route::middleware('role:Admin')->prefix('/admin')->group(function () {
    //Job Application Files
    Route::get('/jobapps/{id}/resume', [App\Http\Controllers\Index\JobApplicationController::class, 'getResume'])->name('jobsapp.resume');
    Route::get('/jobapps/{id}/coverletter', [App\Http\Controllers\Index\JobApplicationController::class, 'getCoverLetter'])->name('jobsapp.coverletter');
});
