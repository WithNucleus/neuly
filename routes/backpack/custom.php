<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => [
        config('backpack.base.web_middleware', 'web'),
        config('backpack.base.middleware_key', 'admin'),
    ],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('company', 'CompanyCrudController');
    Route::crud('focus', 'FocusCrudController');
    Route::crud('person', 'PersonCrudController');
    Route::crud('location', 'LocationCrudController');
    Route::crud('investor', 'InvestorCrudController');
    Route::crud('research', 'ResearchCrudController');
    Route::crud('job', 'JobCrudController');
    Route::crud('event', 'EventCrudController');
    Route::crud('eventtype', 'EventTypeCrudController');
    Route::crud('newsarticle', 'NewsArticleCrudController');
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
    Route::post('rankedList/{id}/addEntity', 'RankedListCrudController@addEntity')->name('admin.rankedList.addEntity');
    Route::post('rankedList/{id}/removeEntity', 'RankedListCrudController@removeEntity')->name('admin.rankedList.removeEntity');
    Route::post('rankedList/{id}/updateEntities', 'RankedListCrudController@updateEntities')->name('admin.rankedList.updateEntities');

    Route::crud('location-geocoding', 'LocationGeocodingCrudController');
    Route::get('location-geocoding/run', 'LocationGeocodingCrudController@runGeocoding')->name('admin.location-geocoding.run');

    Route::crud('person-claim', 'ClaimPersonCrudController');
    Route::get('person-claim/{claim}/approve', 'ClaimPersonCrudController@approve')->name('admin.person-claim.approve');

    Route::group([
        'namespace'  => 'ClinicalTrialDetails',
    ], function (){
        Route::crud('ct_condition', 'CtConditionCrudController');
        Route::crud('ct_intervention', 'CtInterventionCrudController');
        Route::crud('ct_outcome_measure', 'CtOutcomeMeasureCrudController');
        Route::crud('ct_study_design', 'CtStudyDesignCrudController');
    });

    Route::group([
        'as' => 'admin.'
    ], function () {
        Route::crud('listingrequest', 'ListingRequestCrudController');
        Route::group([
            'prefix' => 'listingrequest',
            'as' => 'listingrequest.'
        ], function () {
            Route::get('{id}/decline', 'ListingRequestCrudController@getDeclineForm')->name('decline');
            Route::post('{id}/decline', 'ListingRequestCrudController@postDeclineForm');
            Route::get('{id}/accept', 'ListingRequestCrudController@getAcceptForm')->name('accept');
            Route::post('{id}/accept', 'ListingRequestCrudController@postAcceptForm');
        });
    });

    // imports group
    Route::group([
        'prefix' => 'import',
        'namespace' => 'Import',
        'as' => 'admin.import.',
        'middleware' => ['permission:import'],
    ], function () {

        Route::group([
            'prefix' => 'clinicaltrial',
            'namespace' => 'ClinicalTrial',
            'as' => 'clinicaltrial.',
        ], function () {
            Route::crud('parsing', 'ParsingController');
            Route::post('parsing/bulkImport', 'ParsingController@bulkImport')->name('parsing.bulkImport');
            Route::crud('parsing-results', 'ParsingResultsController');
            Route::get('parsing-results/{id}/approve', 'ParsingResultsController@approve')->name('parsing-results.approve');
        });

        Route::group([
            'prefix' => 'company',
            'namespace' => 'Company',
            'as' => 'company.',
        ], function () {
            Route::crud('serpapi', 'SerpapiController');
            Route::post('serpapi/bulkImport', 'SerpapiController@bulkImport')->name('serpapi.bulkImport');
            Route::crud('serpapi-data', 'SerpapiDataController');
            Route::get('serpapi-data/{id}/mark-as-reviewed', 'SerpapiDataController@markAsReviewed')->name('serpapi-data.markAsReviewed');
            Route::get('serpapi-data/{id}/review', 'SerpapiDataController@review')->name('serpapi-data.review');
            Route::post('serpapi-data/{id}/review', 'SerpapiDataController@reviewSubmit');
        });

        Route::group([
            'prefix' => 'people',
            'as' => 'people.',
        ], function () {
            Route::get('/', 'PeopleController@index')->name('index');
            Route::post('/process', 'PeopleController@process')->name('process');
        });

    });
}); // this should be the absolute last line of this file
