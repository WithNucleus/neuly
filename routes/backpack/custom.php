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

    Route::group([
        'namespace'  => 'ClinicalTrialDetails',
    ], function (){
        Route::crud('ct_condition', 'CtConditionCrudController');
        Route::crud('ct_intervention', 'CtInterventionCrudController');
        Route::crud('ct_outcome_measure', 'CtOutcomeMeasureCrudController');
        Route::crud('ct_study_design', 'CtStudyDesignCrudController');
    });

    Route::crud('listingrequest', 'ListingRequestCrudController');
    Route::crud('jobapplication', 'JobApplicationCrudController');
    Route::crud('redirect', 'RedirectCrudController');
    Route::crud('feedback', 'FeedbackCrudController');
    Route::crud('clinicaltrialphase', 'ClinicaltrialPhaseCrudController');
    Route::crud('log-embed', 'LogEmbedCrudController');
    Route::crud('insightRequest', 'InsightRequestCrudController');
    Route::crud('jobreportentries', 'JobReportEntryCrudController');
    Route::crud('searchlog', 'SearchLogCrudController');
}); // this should be the absolute last line of this file
