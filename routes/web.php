<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth Routes for Front-End
Auth::routes(['verify' => true]);

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')->name('login.social');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

// Homepage
Route::get('/', 'Content\HomeController@index')->name('index');
Route::get('/home', 'Content\HomeController@index')->name('home');

// Content
Route::get('/about', 'Content\AboutController@index')->name('about');

// Discover Index
Route::get('/psychedelic-index', 'Content\IndexController@index')->name('discover.index');

//Insights main page
Route::group([
    'middleware' => 'verifiedIfAuthorized',
], function () {
    Route::get('/insights', 'Index\InsightsController@index')->name('discover.insights');
    Route::get('/insights/request', 'Index\InsightsController@request')->name('discover.insights.request');
    Route::post('/insights/request', 'Index\InsightsController@saveRequest')->name('discover.insights.saveRequest');
});

//Insights
Route::group([
    'prefix'     => '/insights',
    'namespace'  => 'Insights',
    'as'         => 'insights.',
], function () {

    //demo insights
    Route::get('/companies-by-type', 'CompaniesByTypeController@index')->name('companies-by-type');
    Route::get('/top-ten-locations', 'TopTenLocationsController@index')->name('top-ten-locations');
    Route::get('/companies-by-focus-drug', 'CompaniesByFocusDrug@index')->name('companies-by-focus-drug');
    Route::get('/clinical-trial-tracker', 'ClinicalTrialPipelineController@show')->name('clinicaltrials.pipeline');

    //insights only for registered users
    Route::group([
        'middleware' => ['auth', 'verified'],
    ], function () {
        Route::get('/jobs-by-focus', 'JobsByFocusController@index')->name('jobs-by-focus');
        Route::get('/jobs-by-type', 'JobsByTypeController@index')->name('jobs-by-type');
        Route::get('/collaborators', 'ClinicalTrialCollaboratorsListController@show')->name('collaborators.show');
        Route::post('/collaborators/list', 'ClinicalTrialCollaboratorsListController@index')->name('collaborators');
        Route::get('/most-interest', 'ClinicalTrialFocusListController@show')->name('most-interest.show');
        Route::post('/most-interest/list', 'ClinicalTrialFocusListController@index')->name('most-interest');
        Route::get('/research-authors', 'ResearchAuthorsController@index')->name('research-authors');
        Route::get('/research-authors/widget', 'ResearchAuthorsController@widget')->name('research-authors.widget');
        Route::get('/research-organizations', 'ResearchOrganizationsController@index')->name('research-organizations');
        Route::get('/research-organizations/widget', 'ResearchOrganizationsController@widget')->name('research-organizations.widget');
        Route::get('/research-by-focus', 'ResearchByFocus@index')->name('research-by-focus');
        Route::get('/companies-by-focus-industry', 'CompaniesByFocusIndustry@index')->name('companies-by-focus-industry');
        Route::get('/location-top-by-jobs', 'LocationTopByJobsController@index')->name('location-top-by-jobs');
        Route::get('/clinical-trials/distribution/countries', 'ClinicalTrialDistributionController@show')->name('distribution.countries.show');
        Route::get('/clinical-trials/distribution/countries/focus', 'ClinicalTrialDistributionController@showWithFocus')->name('distribution.countries.focus.show');
    });
});

// Search Suggestions
Route::group([
    'prefix'     => '/searchassets',
    'namespace'  => 'Index',
    'as'         => 'searchassets.',
], function () {
    Route::get('/everything.json', 'SearchSuggestionsController@everything')->name('everything');
    Route::get('/researchAuthors.json', 'SearchSuggestionsController@researchAuthors')->name('researchAuthors');
    Route::get('/investorsPeople.json', 'SearchSuggestionsController@investorsPeople')->name('investorsPeople');
    Route::get('/investorsOrganizations.json', 'SearchSuggestionsController@investorsOrganizations')->name('investorsOrganizations');
    Route::get('/companiesLocations.json', 'SearchSuggestionsController@companiesLocations')->name('companiesLocations');
    Route::get('/locationsRegions.json', 'SearchSuggestionsController@locationsRegions')->name('locationsRegions');
    Route::get('/focusOrganizations.json', 'SearchSuggestionsController@focusOrganizations')->name('focusOrganizations');
    Route::get('/clinicalTrialCollaborators.json', 'SearchSuggestionsController@clinicalTrialCollaborators')->name('clinicalTrialCollaborators');
    Route::get('/clinicalTrialResearchers.json', 'SearchSuggestionsController@clinicalTrialResearchers')->name('clinicalTrialResearchers');
    Route::get('/clinicalTrialConditions.json', 'SearchSuggestionsController@clinicalTrialConditions')->name('clinicalTrialConditions');
    Route::get('/clinicalTrialInterventions.json', 'SearchSuggestionsController@clinicalTrialInterventions')->name('clinicalTrialInterventions');
    Route::get('/clinicalTrialOutcomeMeasures.json', 'SearchSuggestionsController@clinicalTrialOutcomeMeasures')->name('clinicalTrialOutcomeMeasures');
    Route::get('/clinicalTrialStudyDesigns.json', 'SearchSuggestionsController@clinicalTrialStudyDesigns')->name('clinicalTrialStudyDesigns');
});

// Companies
Route::get('/organizations', 'Index\CompanyController@index')->name('discover.organizations');
Route::get('/organization/names.json', 'Index\CompanyController@namesJson');
Route::get('/organization/{slug}', 'Index\CompanyController@show')->name('discover.organizations.show');
Route::get('/organization/{slug}/jobs', 'Index\CompanyController@jobs')->name('discover.organizations.jobs');
Route::get('/organization/{slug}/events', 'Index\CompanyController@events')->name('discover.organizations.events');

// People
Route::get('/people', 'Index\PersonController@index')->name('discover.people');
Route::get('/people/names.json', 'Index\PersonController@namesJson');
Route::get('/person/{slug}', 'Index\PersonController@show')->name('discover.people.show');

// Research
Route::get('/research', 'Index\ResearchController@index')->name('discover.research');
Route::get('/research/names.json', 'Index\ResearchController@namesJson');
Route::get('/research/{slug}', 'Index\ResearchController@show')->name('discover.research.show');

// Investors
Route::get('/investors', 'Index\InvestorController@index')->name('discover.investors');
Route::get('/investor/names.json', 'Index\InvestorController@namesJson');
Route::get('/investor/{slug}', 'Index\InvestorController@show')->name('discover.investors.show');

// Locations
Route::get('/locations', 'Index\LocationController@index')->name('discover.locations');
Route::get('/locations/citynames.json', 'Index\LocationController@citynames');
Route::get('/locations/countries.json', 'Index\LocationController@countries');
Route::get('/location/{slug}', 'Index\LocationController@show')->name('discover.locations.show');

// Focus
Route::get('/focus', 'Index\FocusController@index')->name('discover.focus');
Route::get('/focus/{slug}', 'Index\FocusController@show')->name('discover.focus.show');

// Events
Route::get('/events', 'Index\EventController@index')->name('discover.events');
Route::get('/events/embed-widget', 'Index\EventController@embedWidget')->name('discover.events.embedWidget');
Route::get('/past-events', 'Index\EventController@past')->name('discover.events.past');
Route::get('/events/citynames.json', 'Index\EventController@citynames');
Route::get('/events/names.json', 'Index\EventController@namesJson');
Route::get('/events/{slug}', 'Index\EventController@show')->name('discover.events.show');

// Jobs
Route::get('/jobs', 'Index\JobController@index')->name('discover.jobs');
Route::get('/jobs/embed-widget', 'Index\JobController@embedWidget')->name('discover.jobs.embedWidget');
Route::get('/jobs/citynames.json', 'Index\JobController@citynames');
Route::get('/jobs/{slug}', 'Index\JobController@show')->name('discover.jobs.show');
Route::get('/jobs/apply/{slug}', 'Index\JobApplicationController@index')->name('discover.jobs.apply');
Route::post('/jobs/apply', 'Index\JobApplicationController@apply')->name('discover.jobs.applyProcess');

// Clinical trials
Route::get('/clinical-trials', 'Index\ClinicaltrialController@index')->name('discover.clinicaltrials');
Route::get('/clinical-trials/{slug}', 'Index\ClinicaltrialController@show')->name('discover.clinicaltrials.show');

// Listing Requests
Route::get('/listing', 'Index\ListingRequestController@index')->name('listing');
Route::get('/listing/request', 'Index\ListingRequestController@request')->name('listing.request');
Route::post('/listing/request/finish', 'Index\ListingRequestController@processData')->name('listing.request.finish');
Route::post('/listing/request/{type}', 'Index\ListingRequestController@entityForm')->name('listing.request.investor');

Route::get('/job-report-entry', 'Index\JobReportEntryController@index')->name('job-report-entry.index');
Route::post('/job-report-entry', 'Index\JobReportEntryController@store')->name('job-report-entry.store');;

// Search
Route::post('/search', 'Index\SearchController@search')->name('search');
Route::get('/search/{term}', 'Index\SearchController@index')->name('search.index');

Route::post('/search/organizations', 'index\SearchController@showOrganizationResults')->name('search.organizations');
Route::post('/search/organizations/{term}', 'Index\SearchController@showOrganizationResults');
Route::get('/search/organizations/{term}', 'Index\SearchController@showOrganizationResults');

Route::post('/search/people', 'index\SearchController@showPeopleResults')->name('search.people');
Route::post('/search/people/{term}', 'Index\SearchController@showPeopleResults');
Route::get('/search/people/{term}', 'Index\SearchController@showPeopleResults');

Route::post('/search/investors', 'index\SearchController@showInvestorResults')->name('search.investors');
Route::post('/search/investors/{term}', 'Index\SearchController@showInvestorResults');
Route::get('/search/investors/{term}', 'Index\SearchController@showInvestorResults');

Route::post('/search/research', 'index\SearchController@showResearchResults')->name('search.research');
Route::post('/search/research/{term}', 'Index\SearchController@showResearchResults');
Route::get('/search/research/{term}', 'Index\SearchController@showResearchResults');

Route::post('/search/locations', 'index\SearchController@showLocationResults')->name('search.locations');
Route::post('/search/locations/{term}', 'Index\SearchController@showLocationResults');
Route::get('/search/locations/{term}', 'Index\SearchController@showLocationResults');

Route::post('/search/focus', 'index\SearchController@showFocusResults')->name('search.focus');
Route::post('/search/focus/{term}', 'Index\SearchController@showFocusResults');
Route::get('/search/focus/{term}', 'Index\SearchController@showFocusResults');

Route::post('/search/events', 'index\SearchController@showEventResults')->name('search.events');
Route::post('/search/events/{term}', 'Index\SearchController@showEventResults');
Route::get('/search/events/{term}', 'Index\SearchController@showEventResults');

Route::post('/search/jobs', 'index\SearchController@showJobResults')->name('search.jobs');
Route::post('/search/jobs/{term}', 'Index\SearchController@showJobResults');
Route::get('/search/jobs/{term}', 'Index\SearchController@showJobResults');

Route::post('/search/clinicaltrials', 'index\SearchController@showClinicalTrialsResults')->name('search.clinicaltrials');
Route::get('/search/clinicaltrials/{term}', 'Index\SearchController@showClinicalTrialsResults')->name('search.clinicaltrials.term');

// Feedback

Route::get('/feedback', 'FeedbackController@create')->name('feedback.create');
Route::post('/feedback', 'FeedbackController@store')->name('feedback.store');

// Thanks for Registering Page
Route::get('/register/success', 'Auth\SuccessController@thanks')->name('register.success');

/* MEMBER DASHBOARD */
Route::get('/dashboard', 'Dashboard\DashboardController@index')
    ->middleware('verifiedIfAuthorized')
    ->name('member.dashboard');

Route::group(['middleware' => ['auth', 'verified']], function () {

    /* MEMBER DASHBOARD PAGES */
    Route::group(['prefix' => '/dashboard'], function () {

        // Notes
        Route::get('/add-note', 'Dashboard\NoteController@create')->name('member.notes.create');
        Route::post('/add-note', 'Dashboard\NoteController@store')->name('member.notes.store');
        Route::post('/validate-note', 'Dashboard\NoteController@checkSlug')->name('member.notes.validate');
        Route::get('/edit-note/{slug}', 'Dashboard\NoteController@edit')->name('member.notes.edit');
        Route::get('/notes/{id}/destroy', 'Dashboard\NoteController@destroy')->name('member.notes.destroy');
        Route::post('/edit-note/{id}', 'Dashboard\NoteController@update')->name('member.notes.update');
        Route::get('/notes', 'Dashboard\NoteController@index')->name('member.notes.index');
        Route::get('/notes/{slug}', 'Dashboard\NoteController@show')->name('member.notes.show');

        // Follow lists
        Route::post('/follow-lists/ajax-store', 'Dashboard\FollowListsController@ajaxStore')->name('member.follow-lists.ajaxStore');
        Route::post('/follow-lists/validate-name', 'Dashboard\FollowListsController@validateName')->name('member.follow-lists.validateName');
        Route::resource('/follow-lists', 'Dashboard\FollowListsController', [
            'as' => 'member',
            'except' => ['create']
        ]);

        // Follow
        Route::resource('/follow', 'Dashboard\FollowController', [
            'as' => 'member',
            'except' => ['create', 'store', 'destroy']
        ]);

        Route::get('/notifications', 'NotificationController@index')->name('dashboard.notifications.index');
        Route::get('/notifications/read', 'NotificationController@setReadAll');
        Route::get('/notifications/{notification}', 'NotificationController@show')->name('dashboard.notifications.show');
        Route::get('/notifications/{notification}/read', 'NotificationController@setRead');
    });

    // Follow / Unfollow actions
    Route::get('/follow//get-modal/{id}/{type}', 'Dashboard\FollowController@getModal')->name('member.follow.getModal');
    Route::post('/follow/attach', 'Dashboard\FollowController@attach')->name('member.follow.attach');
    Route::post('/follow/detach', 'Dashboard\FollowController@detach')->name('member.follow.detach');

    // Notifications

    Route::get('/user/notifications', 'NotificationController@getNotificationsByAuthedUser');
    Route::get('/user/notifications/unread', 'NotificationController@getUnreadNotificationsCountByAuthedUser');

    // User Settings Page
    Route::get('/user/settings', 'Index\UserProfileController@index')->name('user.settings');
    Route::post('/user/settings', 'Index\UserProfileController@update');
    Route::get('/user/settings/email', 'Index\UserEmailController@index')->name('user.settings.email');
    Route::post('/user/settings/email', 'Index\UserEmailController@update');
    Route::get('/user/settings/password', 'Index\UserPasswordController@index')->name('user.settings.password');
    Route::post('/user/settings/password', 'Index\UserPasswordController@update');
    Route::post('/user/settings/validateurl', 'Index\UserProfileController@checkMemberUrl')->name('user.validate.member_url');
});

// User Email Reset
Route::get('/user/retake/{token}', 'Index\UserRetakeController@index')->name('user.retake');

/* SPECIAL ADMIN CONTROLLERS */
Route::group([
    'prefix'     => '/admin/company/{company_id}',
    'namespace'  => 'Admin\Company',
    'as'         => 'admin.company.',
    'middleware' => ['permission:edit companies'],
], function () {
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


Route::get('/admin/person/{id}/company', 'Admin\PersonCompanyController@index');
Route::post('/admin/person/{id}/company', 'Admin\PersonCompanyController@add');

Route::get('/admin/investor/{id}/person', 'Admin\InvestorPersonController@index');
Route::post('/admin/investor/{id}/person', 'Admin\InvestorPersonController@add');
Route::get('/admin/investor/{investor_id}/person/{person_id}/remove', 'Admin\InvestorPersonController@remove')->name('investorperson.remove');

Route::get('/admin/person/{id}/investor', 'Admin\PersonInvestorController@index');
Route::post('/admin/person/{id}/investor', 'Admin\PersonInvestorController@add');

// Import Clinical Trials
Route::get('/admin/import/clinicaltrials', 'Admin\Import\ClinicalTrialController@importClinicaltrials')
    ->name('import.clinicaltrials');
Route::post('/admin/import/clinicaltrials', 'Admin\Import\ClinicalTrialController@processClinicaltrials')
    ->name('import.clinicaltrials.process');

//Import Settings
Route::get('/admin/import/settings', 'Admin\Import\SettingsController@index')
    ->name('import.settings.index');
Route::post('/admin/import/settings', 'Admin\Import\SettingsController@update')
    ->name('import.settings.update');

// Import Research
Route::get('/admin/import/research', 'Admin\Import\ResearchController@start')
    ->name('import.research');

Route::post('/admin/import/research', 'Admin\Import\ResearchController@search')
    ->name('import.research.process');

Route::post('/admin/import/research/save', 'Admin\Import\ResearchController@import')
    ->name('import.research.save');

// Import Results Show
Route::get('/admin/import/results/{id}', 'Admin\Import\ResultsController@showResults')
    ->name('import.results');

//Fix Import Failure
Route::post('/admin/import/failures/{id}/fix', 'Admin\Import\FailuresController@fix')
    ->name('import.failures.fix');
Route::post('/admin/import/failures/{id}/delete', 'Admin\Import\FailuresController@delete')
    ->name('import.failures.delete');

// Related Entities
Route::group([
    'middleware' => ['auth', 'role:Admin','permission:import'],
    'prefix'     => '/admin/import',
    'namespace'  => 'Admin\Import',
    'as'         => 'import.',
], function () {
    Route::group([
        'prefix' => '/related-entities',
        'as'     => 'related-entities.'
    ], function () {
        Route::get('/', 'RelatedEntitiesController@index')->name('index');

        Route::group([
            'prefix' => '/locations',
            'namespace'  => 'RelatedEntities',
            'as'     => 'locations.'
        ], function () {
            Route::get('/', 'LocationsController@index')->name('index');
            Route::post('/import', 'LocationsController@import')->name('import');
            Route::get('/results/{id}', 'LocationsController@results')->name('results');
            Route::get('/failures/{id}', 'LocationsController@failures')->name('failures');
        });

        Route::group([
            'prefix' => '/people-organization',
            'namespace'  => 'RelatedEntities',
            'as'     => 'people-organization.'
        ], function () {
            Route::get('/', 'PeopleOrganizationController@index')->name('index');
            Route::post('/import', 'PeopleOrganizationController@import')->name('import');
            Route::get('/results/{id}', 'PeopleOrganizationController@results')->name('results');
            Route::get('/failures/{id}', 'PeopleOrganizationController@failures')->name('failures');
        });

    });

    Route::group([
        'prefix' => '/batch-images-upload',
        'as'     => 'batch-images-upload.'
    ], function () {
        Route::get('/', 'BatchImagesUploadController@index')->name('index');
        Route::post('/import', 'BatchImagesUploadController@import')->name('import');
        Route::get('/results/{id}', 'BatchImagesUploadController@results')->name('results');
        Route::get('/failures/{id}', 'BatchImagesUploadController@failures')->name('failures');
    });
});

//Import Failures List
Route::get('/admin/import/{id}/failures', 'Admin\Import\ResultsController@showFailures')
    ->name('import.failures');
Route::get('/admin/import/{id}/failures/{type}', 'Admin\Import\FailuresController@showByType')
    ->name('import.failures.showByType');

// Job Application Files
Route::get('/admin/jobapps/{id}/resume', 'Index\JobApplicationController@getResume')->name('jobsapp.resume');
Route::get('/admin/jobapps/{id}/coverletter', 'Index\JobApplicationController@getCoverLetter')->name('jobsapp.coverletter');

// Admin Routes
Route::group([
    'prefix'     => 'admin',
    'middleware' => ['role:Admin'],
    'namespace'  => 'Admin',
], function () {
    // Entity Merge
    Route::group(['prefix' => 'entity-merge'], function () {
        Route::get('/', 'EntityMergeController@index')
            ->name('admin.entityMerge');
        Route::get('/get-list', 'EntityMergeController@getEntityListJson')
            ->name('admin.entityMerge.getEntityListJson');
        Route::get('/get-entity-form', 'EntityMergeController@getEntityForm')
            ->name('admin.entityMerge.getEntityForm');
        Route::post('/merge', 'EntityMergeController@merge')
            ->name('admin.entityMerge.merge');
    });
});

/* MEMBERS - PUBLIC ROUTES */
Route::get('/members/{member_url}/lists/{slug}', 'Dashboard\FollowListsController@showPublic')->name('members.follow-lists.public');
Route::get('/members/{member_url}/{slug}', 'Dashboard\NoteController@showPublic')->name('members.public.note');

Route::group([
    'prefix' => 'embeds',
    'as' => 'embeds.'
], function() {
    Route::get('/jobs', 'Index\JobController@embedIndex')->name('jobs.index');
    Route::get('/events', 'Index\EventController@embedIndex')->name('events.index');
});

/** CATCH-ALL ROUTE for Backpack/PageManager - needs to be at the end of your routes.php file  **/
Route::get('{page}/{subs?}', ['uses' => '\App\Http\Controllers\PageController@index'])
    ->where(['page' => '^(((?=(?!admin))(?=(?!\/)).))*$', 'subs' => '.*']);
