<?php

use App\Http\Controllers\Dashboard\TeamController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExternalScriptController;

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

Route::group(['middleware' => 'firewall.all'], function () {
    Auth::routes(['verify' => true]);
    Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')->name('login.social');
    Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
});

//TODO seems this method is not used anymore, check and remove
Route::get('/register/success', 'Auth\MessagesController@registerSuccess')->name('register.success');

Route::get('/invitation', 'InvitationController@show')->name('invitation.show');
Route::post('/invitation', 'InvitationController@accept')->name('invitation.accept');

Route::get('/', 'Content\HomeController@index')->name('index');
Route::get('/about', 'Content\AboutController@index')->name('about');

// Search Suggestions
Route::group([
    'prefix' => '/searchassets',
    'namespace' => 'Index',
    'as' => 'searchassets.',
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

//Other searches
Route::get('/organization/names.json', 'Index\CompanyController@namesJson');

// Non-Auth Gate
Route::get('/clinical-trials/recruiting', 'Index\RecruitingClinicalTrialController@index')->name('discover.clinicaltrials.recruiting');
Route::get('/videos', 'Index\DataFeeds\VideoController@index')->name('discover.videos');
Route::get('/podcasts', 'Index\DataFeeds\PodcastController@index')->name('discover.podcasts');
Route::get('/podcasts/{slug}', 'Index\DataFeeds\PodcastController@show')->name('discover.podcasts.show');
Route::get('/books', 'Index\DataFeeds\BookController@index')->name('discover.books');
Route::get('/courses', 'Index\CourseController@index')->name('discover.courses');

//Global group for registered and verified users only
Route::group([
    'middleware' => ['verifiedIfAuthorized'],
], function () {
    Route::get('/psychedelic-index', 'Content\IndexController@index')->name('discover.index');

    // Companies
    Route::get('/organizations', 'Index\CompanyController@index')->name('discover.organizations');
    Route::get('/organization/map', 'Index\CompanyMapController@showMap')->name('discover.organizations.map');
    Route::get('/organization/map/{country}', 'Index\CompanyMapController@showCountry')->name('discover.organizations.map.country');
    Route::get('/organization/{slug}/jobs', 'Index\CompanyController@jobs')->name('discover.organizations.jobs');
    Route::get('/organization/{slug}/events', 'Index\CompanyController@events')->name('discover.organizations.events');

    // People
    Route::get('/people', 'Index\PersonController@index')->name('discover.people');
    Route::get('/people/names.json', 'Index\PersonController@namesJson');
    Route::post('/person/{slug}/claim', 'Index\PersonController@claim')->name('discover.people.claim');
    Route::get('/person/{slug}/requestDeletion', 'Index\PersonController@requestDeletion')->name('discover.people.requestDeletion');
    Route::post('/person/{slug}/requestDeletion', 'Index\PersonController@requestDeletionSubmit');

    // Research
    Route::get('/research', 'Index\ResearchController@index')->name('discover.research');
    Route::get('/research/names.json', 'Index\ResearchController@namesJson');
    Route::get('/research/{slug}', 'Index\ResearchController@show')->name('discover.research.show');

    // Investors
    Route::get('/investors', 'Index\InvestorController@index')->name('discover.investors');
    Route::get('/investor/names.json', 'Index\InvestorController@namesJson');
    Route::get('/investors/map', 'Index\InvestorMapController@showMap')->name('discover.investors.map');
    Route::get('/investors/map/{country}', 'Index\InvestorMapController@showCountry')->name('discover.investors.map.country');
    Route::get('/investor/{slug}', 'Index\InvestorController@show')->name('discover.investors.show');
    Route::get('/investor/{slug}/jobs', 'Index\InvestorController@jobs')->name('discover.investors.jobs');

    // Locations
    Route::get('/locations', 'Index\LocationController@index')->name('discover.locations');
    Route::get('/locations/map', 'Index\LocationMapController@showMap')->name('discover.locations.maps.global');
    Route::get('/locations/map/{country}', 'Index\LocationMapController@showCountry')->name('discover.locations.maps.country');
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
    Route::get('/archived-jobs', 'Index\JobController@archive')->name('discover.jobs-archive');
    Route::get('/jobs/embed-widget', 'Index\JobController@embedWidget')->name('discover.jobs.embedWidget');
    Route::get('/jobs/titles.json', 'Index\JobController@titlesJson')->name('discover.jobs.titlesJson');
    Route::get('/jobs/map', 'Index\JobMapController@showMap')->name('discover.jobs.map');
    Route::get('/jobs/map/{country}', 'Index\JobMapController@showCountry')->name('discover.jobs.map.country');
    Route::get('/jobs/{slug}', 'Index\JobController@show')->name('discover.jobs.show');
    Route::get('/jobs/apply/{slug}', 'Index\JobApplicationController@index')->name('discover.jobs.apply');
    Route::post('/jobs/apply', 'Index\JobApplicationController@apply')->name('discover.jobs.applyProcess');

    // Clinical trials
    Route::get('/clinical-trials', 'Index\ClinicaltrialController@index')->name('discover.clinicaltrials');
    Route::get('/clinical-trials/map', 'Index\ClinicalTrialMapController@showMap')->name('discover.clinicaltrials.map');
    Route::get('/clinical-trials/map/{country}', 'Index\ClinicalTrialMapController@showCountry')->name('discover.clinicaltrials.map.country');
    Route::get('/clinical-trials/{slug}', 'Index\ClinicaltrialController@show')->name('discover.clinicaltrials.show');

    // News Articles
    Route::get('/news', 'Index\NewsArticleController@index')->name('discover.news');

    // Listing Requests
    Route::get('/listing', 'Index\ListingRequestController@index')->name('listing');
    Route::get('/listing/request', 'Index\ListingRequestController@request')->name('listing.request');
    Route::get('/listing/request/getEntityListJson', 'Index\ListingRequestController@getEntityListJson')->name('listing.request.getEntityListJson');

    Route::get('/job-report-entry', 'Index\JobReportEntryController@index')->name('job-report-entry.index');
    Route::post('/job-report-entry', 'Index\JobReportEntryController@store')->name('job-report-entry.store');

    // Search
    Route::post('/search', 'Index\SearchController@search')->name('search');
    Route::get('/search/{term}', 'Index\SearchController@index')->where('term', '(.*)')
        ->name('search.index');

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

    Route::get('/patents', 'Index\PatentController@index')->name('discover.patents');
    Route::get('/patent-tracker', 'Index\PatentController@tracker')->name('discover.patents.tracker');
    Route::get('/patent-filings', 'Index\DataFeeds\PatentFilingController@index')->name('discover.patents.filings');

    //Insights main page
    Route::group([
        'prefix' => '/insights',
        'as' => 'discover.',
    ], function () {
        Route::get('/', 'Index\InsightsController@index')->name('insights');
        Route::get('/request', 'Index\InsightsController@request')->name('insights.request');
        Route::post('/request', 'Index\InsightsController@saveRequest')->name('insights.saveRequest');
    });

    //Insights
    Route::group([
        'prefix' => '/insights',
        'namespace' => 'Insights',
        'as' => 'insights.',
    ], function () {
        Route::get('/companies-by-type', 'CompaniesByTypeController@index')->name('companies-by-type');
        Route::get('/top-ten-locations', 'TopTenLocationsController@index')->name('top-ten-locations');
        Route::get('/companies-by-focus-drug', 'CompaniesByFocusDrug@index')->name('companies-by-focus-drug');
        Route::get('/clinical-trial-tracker', 'ClinicalTrialPipelineController@show')->name('clinicaltrials.pipeline');
        Route::get('/market-comparison', 'CompareMarketController@show')->name('compare-market');
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
        Route::get('/clinical-trials-historic', 'ClinicalTrialHistoric@index')->name('clinical-trials-historic');
        Route::get('/investment-funds', 'InvestmentFundController@index')->name('investment-funds');
        Route::get('/investment-funds/organization/{slug}', 'InvestmentFundController@organizationChart')->name('investment-funds.organization');
        Route::get('/non-profits', 'NonProfitFocusController@chart')->name('nonprofits.focus-chart');
        Route::get('/educational-organizations', 'EducationalOrganizationsMapController@map')->name('educational-organizations.map');
    });
});

// show entity routes with preview feature
Route::get('/organization/{slug}', 'Index\CompanyController@show')->name('discover.organizations.show');
Route::get('/person/{slug}', 'Index\PersonController@show')->name('discover.people.show');
// listing request routes with preview check
Route::post('/listing/request', 'Index\ListingRequestController@submitRequest');
Route::post('/listing/request/finish', 'Index\ListingRequestController@finishRequest')->name('listing.request.finish');

// Feedback
Route::group(['middleware' => 'spamprotection'], function () {
    Route::get('/feedback', 'FeedbackController@create')->name('feedback.create');
    Route::post('/feedback', 'FeedbackController@store')->name('feedback.store');
});

/* MEMBER DASHBOARD */

Route::group([
    'middleware' => ['auth', 'verifiedIfAuthorized'],
], function () {
    Route::group([
        'prefix' => '/dashboard',
    ], function () {
        Route::get('/', 'Dashboard\DashboardController@index')->name('member.dashboard');
        Route::post('/updateWidgetsOrder', 'Dashboard\DashboardController@updateWidgetsOrder')->name('member.dashboard.updateWidgetsOrder');

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
            'except' => ['create'],
        ]);

        // Follow
        Route::resource('/follow', 'Dashboard\FollowController', [
            'as' => 'member',
            'except' => ['create', 'store', 'destroy'],
        ]);
        Route::get('/follow//get-modal/{id}/{type}', 'Dashboard\FollowController@getModal')->name('member.follow.getModal');
        Route::post('/follow/attach', 'Dashboard\FollowController@attach')->name('member.follow.attach');
        Route::post('/follow/detach', 'Dashboard\FollowController@detach')->name('member.follow.detach');

        // Team
        Route::group([
            'prefix' => '/team',
            'as' => 'member.team.',
        ], function () {
            Route::get('/', [TeamController::class, 'index'])->name('index');
            Route::post('/create', [TeamController::class, 'create'])->name('create');
            Route::post('/invite', [TeamController::class, 'invite'])->name('invite');
            Route::delete('/invitation/{invitation_id}', [TeamController::class, 'removeInvitation'])->name('removeInvitation');
            Route::delete('/member/{member_id}', [TeamController::class, 'removeMember'])->name('removeMember');

            Route::post('/{teamId}/leave', [TeamController::class, 'leaveTeam'])->name('leave');
        });
    });

    // Notifications
    //TODO change name to remove 'dashboard' and add name to un-named routes
    Route::get('/notifications', 'NotificationController@index')->name('dashboard.notifications.index');
    Route::get('/notifications/read', 'NotificationController@setReadAll');
    Route::get('/notifications/{notification}', 'NotificationController@show')->name('dashboard.notifications.show');
    Route::get('/notifications/{notification}/read', 'NotificationController@setRead');

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
    Route::get('/user/settings/social', 'Index\UserSocialController@index')->name('user.settings.social');
    Route::get('/user/settings/social/connect/{provider}', 'Index\UserSocialController@connect')->name('user.settings.social.connect');

    Route::get('/user/person/status', 'Index\UserClaimPersonController@status')->name('user.person.status');
    Route::get('/user/person/verify/email', 'Index\UserClaimPersonController@verifyEmail')->name('user.person.verify.email');
    Route::get('/user/person/verify/email/send', 'Index\UserClaimPersonController@sendVerificationMail')->name('user.person.verify.email.send');
    Route::get('/user/person/verify/email/{token}', 'Index\UserClaimPersonController@verifyClaimByEmail')->name('user.person.verify.email.check');
    Route::get('/user/person/verify/social', 'Index\UserClaimPersonController@verifySocial')->name('user.person.verify.social');
    Route::get('/user/person/verify/social/check', 'Index\UserClaimPersonController@verifyClaimBySocial')->name('user.person.verify.social.check');

    Route::get('/user/person', 'Index\UserPersonController@index')->name('user.person.index');
    Route::post('/user/person', 'Index\UserPersonController@savePersonal')->name('user.person.personal.save');
    Route::get('/user/person/email', 'Index\UserPersonController@email')->name('user.person.email');
    Route::post('/user/person/email', 'Index\UserPersonController@saveEmail')->name('user.person.email.save');
    Route::get('/user/person/social', 'Index\UserPersonController@social')->name('user.person.social');
    Route::post('/user/person/social', 'Index\UserPersonController@saveSocial')->name('user.person.social.save');

    Route::get('/user/person/create', 'Index\UserPersonController@create')->name('user.person.create');
    Route::post('/user/person/create/email', 'Index\UserPersonController@storeBasicInformationShowEmailStep')->name('user.person.email.store');
    Route::post('/user/person/create/social', 'Index\UserPersonController@storeEmailShowSocialStep')->name('user.person.social.store');
    Route::post('/user/person/create/finish', 'Index\UserPersonController@storeSocialShowFinishStep')->name('user.person.finish.store');

    Route::get('/user/person/search', 'Index\UserPersonController@search')->name('user.person.search');
});

// Enterprise Dashboard
Route::group(['middleware' => ['auth', 'enterprise.demo']], function () {
    Route::group([
        'as' => 'enterprise.',
        'namespace' => 'Enterprise',
        'prefix' => '/enterprise',
    ], function () {
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
        Route::get('/dashboard/combined-feed', 'DashboardController@combinedFeedWidget')->name('dashboard.combined-feed');
        Route::get('/dashboard/follows', 'DashboardController@userFollowsWidget')->name('dashboard.follows');
        Route::get('/dashboard/notes', 'DashboardController@userNotesWidget')->name('dashboard.notes');
        Route::get('/dashboard/recently-viewed', 'DashboardController@userRecentlyViewedWidget')->name('dashboard.recently-viewed');
        Route::get('/dashboard/team', 'DashboardController@teamWidget')->name('dashboard.team');
        Route::get('/dashboard/patents', 'DashboardController@patentsWidget')->name('dashboard.patents');
        Route::get('/dashboard/clinical-trials', 'DashboardController@clinicalTrialsWidget')->name('dashboard.clinical-trials');
        Route::get('/dashboard/jobs', 'DashboardController@jobsWidget')->name('dashboard.jobs');
        Route::get('/dashboard/events', 'DashboardController@eventsWidget')->name('dashboard.events');
        Route::get('/dashboard/filters', 'DashboardController@filters')->name('dashboard.filters');
        Route::post('/dashboard/save', 'DashboardController@saveWidgets')->name('dashboard.widgets.save');
    });
});

// User Email Reset
Route::get('/user/retake/{token}', 'Index\UserRetakeController@index')->name('user.retake');

// Members public routes for sharing
Route::get('/members/{member_url}/lists/{slug}', 'Dashboard\FollowListsController@showPublic')->name('members.follow-lists.public');
Route::get('/members/{member_url}/{slug}', 'Dashboard\NoteController@showPublic')->name('members.public.note');

Route::group([
    'prefix' => 'embeds',
    'as' => 'embeds.',
], function () {
    Route::get('/jobs', 'Index\JobController@embedIndex')->name('jobs.index');
    Route::get('/events', 'Index\EventController@embedIndex')->name('events.index');
});

Route::get('/js/external/embedSearch/template/{code}', [ExternalScriptController::class, 'getSearchModalTemplate'])->name('js.embedSearch.template');

//SPECIAL ADMIN ROUTES
require __DIR__.'/admin.php';

/* CATCH-ALL ROUTE for Backpack/PageManager - needs to be at the end of your routes.php file  **/
Route::get('{page}', ['uses' => '\App\Http\Controllers\PageController@index'])
    ->where(['page' => '^(((?=(?!admin))(?=(?!\/)).))*$'])
    ->name('page');
