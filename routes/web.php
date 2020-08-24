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
Auth::routes();

// Homepage
Route::get('/', 'Content\HomeController@index')->name('index');
Route::get('/home', 'Content\HomeController@index')->name('home');

// Content
Route::get('/about', 'Content\AboutController@index')->name('about');

// Insights & Index
Route::get('/insights', 'Content\InsightsController@index')->name('discover.insights');
Route::get('/psychedelic-index', 'Content\IndexController@index')->name('discover.index');

// Search Suggestions
Route::get('/searchassets/everything.json', 'Index\SearchSuggestionsController@everything');
Route::get('/searchassets/researchAuthors.json', 'Index\SearchSuggestionsController@researchAuthors');
Route::get('/searchassets/investorsPeople.json', 'Index\SearchSuggestionsController@investorsPeople');
Route::get('/searchassets/investorsOrganizations.json', 'Index\SearchSuggestionsController@investorsOrganizations');
Route::get('/searchassets/companiesLocations.json', 'Index\SearchSuggestionsController@companiesLocations');
Route::get('/searchassets/locationsRegions.json', 'Index\SearchSuggestionsController@locationsRegions');
Route::get('/searchassets/focusOrganizations.json', 'Index\SearchSuggestionsController@focusOrganizations');

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
Route::get('/past-events', 'Index\EventController@past')->name('discover.events.past');
Route::get('/events/citynames.json', 'Index\EventController@citynames');
Route::get('/events/names.json', 'Index\EventController@namesJson');
Route::get('/events/{slug}', 'Index\EventController@show')->name('discover.events.show');

// Jobs
Route::get('/jobs', 'Index\JobController@index')->name('discover.jobs');
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

// Search
Route::post('/search', 'Index\SearchController@index')->name('search');
Route::post('/search/{term}', 'Index\SearchController@index')->name('search.term.results');
Route::get('/search/{term}', 'Index\SearchController@index')->name('search.term');

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

// Thanks for Registering Page
Route::get('/register/success', 'Auth\SuccessController@thanks')->name('register.success');

/* MEMBER DASHBOARD */
Route::get('/dashboard', 'Dashboard\DashboardController@index')->name('member.dashboard');

Route::group(['middleware' => 'auth'], function () {

    /* MEMBER DASHBOARD PAGES */
    Route::group(['prefix' => '/dashboard'], function () {
        // Bookmark Lists
        Route::get('/bookmarks', 'Dashboard\BookmarkListController@index')->name('member.bookmarks.index');
        Route::get('/create-bookmark-list', 'Dashboard\BookmarkListController@create')->name('member.bookmarks.create-form');
        Route::post('/save-bookmark-list', 'Dashboard\BookmarkListController@quickSave')->name('member.bookmarks.quick-save');
        Route::post('/bookmarks', 'Dashboard\BookmarkListController@store')->name('member.bookmarks.store-list');
        Route::get('/bookmarks/{slug}', 'Dashboard\BookmarkListController@show')->name('member.bookmarks.show-list');
        Route::get('/edit-list/{slug}', 'Dashboard\BookmarkListController@edit')->name('member.bookmarks.edit-list');
        Route::get('/lists/{id}/destroy', 'Dashboard\BookmarkListController@destroy')->name('member.bookmarks.destroy-list');
        Route::post('/edit-list/{id}', 'Dashboard\BookmarkListController@update')->name('member.bookmarks.update-list');

        // Bookmarks
        Route::get('/all-bookmarks', 'Dashboard\BookmarkController@index')->name('member.bookmarks.all');
        Route::get('/bookmark/{entity}/{entity_id}-{name}', 'Dashboard\BookmarkController@add')->name('member.bookmarks.add');
        Route::post('/bookmark/{entity}/{entity_id}', 'Dashboard\BookmarkController@store')->name('member.bookmarks.store');
        Route::get('/edit-bookmark/{id}', 'Dashboard\BookmarkController@edit')->name('member.bookmarks.edit');
        Route::post('/edit-bookmark/{id}', 'Dashboard\BookmarkController@update')->name('member.bookmarks.update');
        Route::get('/bookmarks/{id}/destroy', 'Dashboard\BookmarkController@destroy')->name('member.bookmarks.destroy');

        // Notes
        Route::get('/add-note', 'Dashboard\NoteController@create')->name('member.notes.create');
        Route::post('/add-note', 'Dashboard\NoteController@store')->name('member.notes.store');
        Route::post('/validate-note', 'Dashboard\NoteController@checkSlug')->name('member.notes.validate');
        Route::get('/edit-note/{slug}', 'Dashboard\NoteController@edit')->name('member.notes.edit');
        Route::get('/notes/{id}/destroy', 'Dashboard\NoteController@destroy')->name('member.notes.destroy');
        Route::post('/edit-note/{id}', 'Dashboard\NoteController@update')->name('member.notes.update');
        Route::get('/notes', 'Dashboard\NoteController@index')->name('member.notes.index');
        Route::get('/notes/{slug}', 'Dashboard\NoteController@show')->name('member.notes.show');

        // Follow
        Route::resource('/follow', 'Dashboard\FollowController', [
            'as' => 'member',
            'except' => ['create', 'store']
        ]);
    });

    // Follow / Unfollow
    Route::get('/follow/{entity}/{id}', 'FollowController@add')->name('member.follow.add');
    Route::post('/follow/{entity}/{id}', 'FollowController@store')->name('member.follow.store');
    Route::get('/unfollow/{entity}/{id}', 'UnfollowController@add')->name('member.unfollow.add');
    Route::post('/unfollow/{entity}/{id}', 'UnfollowController@store')->name('member.unfollow.store');

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

// Charts
Route::get('/charts/companyFocus.json', 'Index\ChartController@companyFocus')->name('charts.company_focus');
// Route::get('/charts/companyType.json', 'Index\ChartController@companyType')->name('charts.company_type');
// Route::get('/charts/topLocations', 'Index\ChartController@topLocations')->name('charts.top_locations');


/* SPECIAL ADMIN CONTROLLERS */
Route::get('/admin/companyperson/{id}', 'Admin\CompanyPersonController@index');
Route::post('/admin/companyperson/{id}', 'Admin\CompanyPersonController@add');
Route::get('/admin/companyperson/{company_id}/person/{person_id}/remove', 'Admin\CompanyPersonController@remove')->name('companyperson.remove');

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

//Import Failures List
Route::get('/admin/import/{id}/failures', 'Admin\Import\ResultsController@showFailures')
    ->name('import.failures');
Route::get('/admin/import/{id}/failures/{type}', 'Admin\Import\FailuresController@showByType')
    ->name('import.failures.showByType');

//Fix Import Failure
Route::post('/admin/import/failures/{id}/fix', 'Admin\Import\FailuresController@fix')
    ->name('import.failures.fix');

// Job Application Files
Route::get('/admin/jobapps/{id}/resume', 'Index\JobApplicationController@getResume')->name('jobsapp.resume');
Route::get('/admin/jobapps/{id}/coverletter', 'Index\JobApplicationController@getCoverLetter')->name('jobsapp.coverletter');

/* MEMBERS - PUBLIC ROUTES */
Route::get('/members/{member_url}/{slug}', 'Dashboard\NoteController@showPublic')->name('members.public.note');
Route::get('/members/{member_url}/lists/{slug}', 'Dashboard\BookmarkListController@showPublic')->name('members.public.bookmark-list');

/** CATCH-ALL ROUTE for Backpack/PageManager - needs to be at the end of your routes.php file  **/
Route::get('{page}/{subs?}', ['uses' => '\App\Http\Controllers\PageController@index'])
    ->where(['page' => '^(((?=(?!admin))(?=(?!\/)).))*$', 'subs' => '.*']);
