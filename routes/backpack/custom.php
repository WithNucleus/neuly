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
    Route::crud('listingrequest', 'ListingRequestCrudController');
    Route::crud('jobapplication', 'JobApplicationCrudController');
    Route::crud('redirect', 'RedirectCrudController');
}); // this should be the absolute last line of this file
