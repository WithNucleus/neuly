<?php

use App\Http\Controllers\App;
use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::prefix(config('backpack.base.route_prefix', 'admin'))->middleware(config('backpack.base.web_middleware', 'web'), config('backpack.base.middleware_key', 'admin'))->group(function () { // custom admin routes
Route::crud('company', 'CompanyCrudController');
    Route::crud('companybranch', 'CompanyBranchCrudController');
    Route::crud('focus', 'FocusCrudController');
    Route::crud('person', 'PersonCrudController');
    Route::crud('location', 'LocationCrudController');
    Route::crud('investor', 'InvestorCrudController');
    Route::crud('research', 'ResearchCrudController');
    Route::crud('job', 'JobCrudController');
    Route::crud('event', 'EventCrudController');
    Route::crud('eventtype', 'EventTypeCrudController');
    Route::crud('clinicaltrial', 'ClinicaltrialCrudController');
    Route::crud('jobapplication', 'JobApplicationCrudController');
    Route::crud('redirect', 'RedirectCrudController');
    Route::crud('feedback', 'FeedbackCrudController');
    Route::crud('clinicaltrialphase', 'ClinicaltrialPhaseCrudController');
    Route::crud('log-embed', 'LogEmbedCrudController');
    Route::crud('insightRequest', 'InsightRequestCrudController');
    Route::crud('jobreportentries', 'JobReportEntryCrudController');
    Route::crud('searchlog', 'SearchLogCrudController');
    Route::crud('companyvaluation', 'CompanyValuationCrudController');
    Route::crud('rankedList', 'RankedListCrudController');
    Route::post('rankedList/{id}/addEntity', [App\Http\Controllers\Admin\RankedListCrudController::class, 'addEntity'])->name('admin.rankedList.addEntity');
    Route::post('rankedList/{id}/removeEntity', [App\Http\Controllers\Admin\RankedListCrudController::class, 'removeEntity'])->name('admin.rankedList.removeEntity');
    Route::post('rankedList/{id}/updateEntities', [App\Http\Controllers\Admin\RankedListCrudController::class, 'updateEntities'])->name('admin.rankedList.updateEntities');
    Route::crud('entitycontent', 'EntityContentCrudController');
    Route::crud('bookable-listing', 'BookableListingCrudController');
    Route::crud('bookable-listing-request', 'BookableListingRequestCrudController');
    Route::crud('directory', 'DirectoryCrudController');

    Route::crud('location-geocoding', 'LocationGeocodingCrudController');
    Route::get('location-geocoding/run', [App\Http\Controllers\Admin\LocationGeocodingCrudController::class, 'runGeocoding'])->name('admin.location-geocoding.run');

    Route::crud('person-claim', 'ClaimPersonCrudController');
    Route::get('person-claim/{claim}/approve', [App\Http\Controllers\Admin\ClaimPersonCrudController::class, 'approve'])->name('admin.person-claim.approve');

    Route::crud('api-user', 'ApiUserCrudController');
    Route::crud('embeddable-search-widget', 'EmbeddableSearchWidgetCrudController');

    Route::crud('ct_condition', 'CtConditionCrudController');
    Route::crud('ct_intervention', 'CtInterventionCrudController');
    Route::crud('ct_outcome_measure', 'CtOutcomeMeasureCrudController');
    Route::crud('ct_study_design', 'CtStudyDesignCrudController');

    Route::name('admin.')->group(function () {
        Route::crud('listingrequest', 'ListingRequestCrudController');
        Route::prefix('listingrequest')->name('listingrequest.')->group(function () {
            Route::get('{id}/decline', [App\Http\Controllers\Admin\ListingRequestCrudController::class, 'getDeclineForm'])->name('decline');
            Route::post('{id}/decline', [App\Http\Controllers\Admin\ListingRequestCrudController::class, 'postDeclineForm']);
            Route::get('{id}/accept', [App\Http\Controllers\Admin\ListingRequestCrudController::class, 'getAcceptForm'])->name('accept');
            Route::post('{id}/accept', [App\Http\Controllers\Admin\ListingRequestCrudController::class, 'postAcceptForm']);
        });
    });

    // imports group
    Route::prefix('import')->name('admin.import.')->middleware('permission:import')->group(function () {
        Route::prefix('clinicaltrial')->name('clinicaltrial.')->group(function () {
            Route::crud('parsing', 'ParsingController');
            Route::post('parsing/bulkImport', [App\Http\Controllers\Admin\Import\ClinicalTrial\ParsingController::class, 'bulkImport'])->name('parsing.bulkImport');
            Route::crud('parsing-results', 'ParsingResultsController');
            Route::get('parsing-results/{id}/approve', [App\Http\Controllers\Admin\Import\ClinicalTrial\ParsingResultsController::class, 'approve'])->name('parsing-results.approve');
        });

        Route::prefix('company')->name('company.')->group(function () {
            Route::crud('serpapi', 'SerpapiController');
            Route::post('serpapi/bulkImport', [App\Http\Controllers\Admin\Import\Company\SerpapiController::class, 'bulkImport'])->name('serpapi.bulkImport');
            Route::crud('serpapi-data', 'SerpapiDataController');
            Route::get('serpapi-data/{id}/mark-as-reviewed', [App\Http\Controllers\Admin\Import\Company\SerpapiDataController::class, 'markAsReviewed'])->name('serpapi-data.markAsReviewed');
            Route::get('serpapi-data/{id}/review', [App\Http\Controllers\Admin\Import\Company\SerpapiDataController::class, 'review'])->name('serpapi-data.review');
            Route::post('serpapi-data/{id}/review', [App\Http\Controllers\Admin\Import\Company\SerpapiDataController::class, 'reviewSubmit']);
        });

        Route::prefix('people')->name('people.')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\Import\PeopleController::class, 'index'])->name('index');
            Route::post('/process', [App\Http\Controllers\Admin\Import\PeopleController::class, 'process'])->name('process');
        });
    });
    Route::crud('patent', 'PatentCrudController');

    Route::middleware('permission:view logs')->group(function () {
        Route::crud('activity-log', 'ActivityLogCrudController');
    });

    Route::crud('oauth-clients', 'OauthClientsCrudController');
    Route::crud('oauth-access-token', 'OauthAccessTokenCrudController');
}); // this should be the absolute last line of this file
