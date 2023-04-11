<?php

use Illuminate\Support\Facades\Auth;
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

Route::middleware('firewall.all')->group(function () {
    Auth::routes(['verify' => true]);
    Route::get('login/{provider}', [App\Http\Controllers\Auth\LoginController::class, 'redirectToProvider'])->name('login.social');
    Route::get('login/{provider}/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleProviderCallback']);
});

//TODO seems this method is not used anymore, check and remove
Route::get('/register/success', [App\Http\Controllers\Auth\MessagesController::class, 'registerSuccess'])->name('register.success');

Route::get('/invitation', [App\Http\Controllers\InvitationController::class, 'show'])->name('invitation.show');
Route::post('/invitation', [App\Http\Controllers\InvitationController::class, 'accept'])->name('invitation.accept');

Route::get('/', [App\Http\Controllers\Content\HomeController::class, 'index'])->name('index');
Route::get('/about', [App\Http\Controllers\Content\AboutController::class, 'index'])->name('about');

// Search Suggestions
Route::prefix('/searchassets')->name('searchassets.')->group(function () {
    Route::get('/everything.json', [App\Http\Controllers\Index\SearchSuggestionsController::class, 'everything'])->name('everything');
    Route::get('/researchAuthors.json', [App\Http\Controllers\Index\SearchSuggestionsController::class, 'researchAuthors'])->name('researchAuthors');
    Route::get('/investorsPeople.json', [App\Http\Controllers\Index\SearchSuggestionsController::class, 'investorsPeople'])->name('investorsPeople');
    Route::get('/investorsOrganizations.json', [App\Http\Controllers\Index\SearchSuggestionsController::class, 'investorsOrganizations'])->name('investorsOrganizations');
    Route::get('/companiesLocations.json', [App\Http\Controllers\Index\SearchSuggestionsController::class, 'companiesLocations'])->name('companiesLocations');
    Route::get('/peopleLocations.json', [App\Http\Controllers\Index\SearchSuggestionsController::class, 'peopleLocations'])->name('peopleLocations');
    Route::get('/investorsLocations.json', [App\Http\Controllers\Index\SearchSuggestionsController::class, 'investorsLocations'])->name('investorsLocations');
    Route::get('/locationsRegions.json', [App\Http\Controllers\Index\SearchSuggestionsController::class, 'locationsRegions'])->name('locationsRegions');
    Route::get('/focusOrganizations.json', [App\Http\Controllers\Index\SearchSuggestionsController::class, 'focusOrganizations'])->name('focusOrganizations');
    Route::get('/clinicalTrialCollaborators.json', [App\Http\Controllers\Index\SearchSuggestionsController::class, 'clinicalTrialCollaborators'])->name('clinicalTrialCollaborators');
    Route::get('/clinicalTrialResearchers.json', [App\Http\Controllers\Index\SearchSuggestionsController::class, 'clinicalTrialResearchers'])->name('clinicalTrialResearchers');
    Route::get('/clinicalTrialConditions.json', [App\Http\Controllers\Index\SearchSuggestionsController::class, 'clinicalTrialConditions'])->name('clinicalTrialConditions');
    Route::get('/clinicalTrialInterventions.json', [App\Http\Controllers\Index\SearchSuggestionsController::class, 'clinicalTrialInterventions'])->name('clinicalTrialInterventions');
    Route::get('/clinicalTrialOutcomeMeasures.json', [App\Http\Controllers\Index\SearchSuggestionsController::class, 'clinicalTrialOutcomeMeasures'])->name('clinicalTrialOutcomeMeasures');
    Route::get('/clinicalTrialStudyDesigns.json', [App\Http\Controllers\Index\SearchSuggestionsController::class, 'clinicalTrialStudyDesigns'])->name('clinicalTrialStudyDesigns');
    Route::get('/peopleOrganizations.json', [App\Http\Controllers\Index\SearchSuggestionsController::class, 'peopleOrganizations'])->name('peopleOrganizations');
});

//Other searches
Route::get('/organization/names.json', [App\Http\Controllers\Index\CompanyController::class, 'namesJson']);

// Non-Auth Gate
Route::get('/clinical-trials/recruiting', [App\Http\Controllers\Index\RecruitingClinicalTrialController::class, 'index'])->name('discover.clinicaltrials.recruiting');
Route::get('/videos', [App\Http\Controllers\Index\DataFeeds\VideoController::class, 'index'])->name('discover.videos');
Route::get('/podcasts', [App\Http\Controllers\Index\DataFeeds\PodcastController::class, 'index'])->name('discover.podcasts');
Route::get('/podcasts/{slug}', [App\Http\Controllers\Index\DataFeeds\PodcastController::class, 'show'])->name('discover.podcasts.show');
Route::get('/books', [App\Http\Controllers\Index\DataFeeds\BookController::class, 'index'])->name('discover.books');
Route::get('/courses', [App\Http\Controllers\Index\CourseController::class, 'index'])->name('discover.courses');

// Listing Requests
Route::get('/listing', [App\Http\Controllers\Index\ListingRequestController::class, 'index'])->name('listing');
Route::get('/listing/request', [App\Http\Controllers\Index\ListingRequestController::class, 'request'])->name('listing.request');
Route::post('/listing/request', [App\Http\Controllers\Index\ListingRequestController::class, 'submitRequest']);
Route::post('/listing/request/finish', [App\Http\Controllers\Index\ListingRequestController::class, 'finishRequest'])->name('listing.request.finish');
Route::get('/listing/request/getEntityListJson', [App\Http\Controllers\Index\ListingRequestController::class, 'getEntityListJson'])->name('listing.request.getEntityListJson');

//Global group for registered and verified users only
Route::middleware('verifiedIfAuthorized')->group(function () {
    Route::get('/psychedelic-index', [App\Http\Controllers\Content\IndexController::class, 'index'])->name('discover.index');

    // Companies
    Route::get('/organizations', [App\Http\Controllers\Index\CompanyController::class, 'index'])->name('discover.organizations');
    Route::get('/organization/map', [App\Http\Controllers\Index\CompanyMapController::class, 'showMap'])->name('discover.organizations.map');
    Route::get('/organization/map/{country}', [App\Http\Controllers\Index\CompanyMapController::class, 'showCountry'])->name('discover.organizations.map.country');
    Route::get('/organization/{slug}/jobs', [App\Http\Controllers\Index\CompanyController::class, 'jobs'])->name('discover.organizations.jobs');
    Route::get('/organization/{slug}/events', [App\Http\Controllers\Index\CompanyController::class, 'events'])->name('discover.organizations.events');

    // People
    Route::get('/people', [App\Http\Controllers\Index\PersonController::class, 'index'])->name('discover.people');
    Route::get('/people/names.json', [App\Http\Controllers\Index\PersonController::class, 'namesJson']);
    Route::post('/person/{slug}/claim', [App\Http\Controllers\Index\PersonController::class, 'claim'])->name('discover.people.claim');
    Route::get('/person/{slug}/requestDeletion', [App\Http\Controllers\Index\PersonController::class, 'requestDeletion'])->name('discover.people.requestDeletion');
    Route::post('/person/{slug}/requestDeletion', [App\Http\Controllers\Index\PersonController::class, 'requestDeletionSubmit']);

    // Research
    Route::get('/research', [App\Http\Controllers\Index\ResearchController::class, 'index'])->name('discover.research');
    Route::get('/research/names.json', [App\Http\Controllers\Index\ResearchController::class, 'namesJson']);
    Route::get('/research/{slug}', [App\Http\Controllers\Index\ResearchController::class, 'show'])->name('discover.research.show');

    // Investors
    Route::get('/investors', [App\Http\Controllers\Index\InvestorController::class, 'index'])->name('discover.investors');
    Route::get('/investor/names.json', [App\Http\Controllers\Index\InvestorController::class, 'namesJson']);
    Route::get('/investors/map', [App\Http\Controllers\Index\InvestorMapController::class, 'showMap'])->name('discover.investors.map');
    Route::get('/investors/map/{country}', [App\Http\Controllers\Index\InvestorMapController::class, 'showCountry'])->name('discover.investors.map.country');
    Route::get('/investor/{slug}', [App\Http\Controllers\Index\InvestorController::class, 'show'])->name('discover.investors.show');
    Route::get('/investor/{slug}/jobs', [App\Http\Controllers\Index\InvestorController::class, 'jobs'])->name('discover.investors.jobs');

    // Locations
    Route::get('/locations', [App\Http\Controllers\Index\LocationController::class, 'index'])->name('discover.locations');
    Route::get('/locations/map', [App\Http\Controllers\Index\LocationMapController::class, 'showMap'])->name('discover.locations.maps.global');
    Route::get('/locations/map/{country}', [App\Http\Controllers\Index\LocationMapController::class, 'showCountry'])->name('discover.locations.maps.country');
    Route::get('/locations/citynames.json', [App\Http\Controllers\Index\LocationController::class, 'citynames']);
    Route::get('/locations/countries.json', [App\Http\Controllers\Index\LocationController::class, 'countries']);
    Route::get('/location/{slug}', [App\Http\Controllers\Index\LocationController::class, 'show'])->name('discover.locations.show');

    // Focus
    Route::get('/focus', [App\Http\Controllers\Index\FocusController::class, 'index'])->name('discover.focus');
    Route::get('/focus/{slug}', [App\Http\Controllers\Index\FocusController::class, 'show'])->name('discover.focus.show');

    // Events
    Route::get('/events', [App\Http\Controllers\Index\EventController::class, 'index'])->name('discover.events');
    Route::get('/events/embed-widget', [App\Http\Controllers\Index\EventController::class, 'embedWidget'])->name('discover.events.embedWidget');
    Route::get('/past-events', [App\Http\Controllers\Index\EventController::class, 'past'])->name('discover.events.past');
    Route::get('/events/citynames.json', [App\Http\Controllers\Index\EventController::class, 'citynames']);
    Route::get('/events/names.json', [App\Http\Controllers\Index\EventController::class, 'namesJson']);
    Route::get('/events/{slug}', [App\Http\Controllers\Index\EventController::class, 'show'])->name('discover.events.show');

    // Jobs
    Route::get('/jobs', [App\Http\Controllers\Index\JobController::class, 'index'])->name('discover.jobs');
    Route::get('/archived-jobs', [App\Http\Controllers\Index\JobController::class, 'archive'])->name('discover.jobs-archive');
    Route::get('/jobs/embed-widget', [App\Http\Controllers\Index\JobController::class, 'embedWidget'])->name('discover.jobs.embedWidget');
    Route::get('/jobs/titles.json', [App\Http\Controllers\Index\JobController::class, 'titlesJson'])->name('discover.jobs.titlesJson');
    Route::get('/jobs/map', [App\Http\Controllers\Index\JobMapController::class, 'showMap'])->name('discover.jobs.map');
    Route::get('/jobs/map/{country}', [App\Http\Controllers\Index\JobMapController::class, 'showCountry'])->name('discover.jobs.map.country');
    Route::get('/jobs/{slug}', [App\Http\Controllers\Index\JobController::class, 'show'])->name('discover.jobs.show');
    Route::get('/jobs/apply/{slug}', [App\Http\Controllers\Index\JobApplicationController::class, 'index'])->name('discover.jobs.apply');
    Route::post('/jobs/apply', [App\Http\Controllers\Index\JobApplicationController::class, 'apply'])->name('discover.jobs.applyProcess');

    // Clinical trials
    Route::get('/clinical-trials', [App\Http\Controllers\Index\ClinicaltrialController::class, 'index'])->name('discover.clinicaltrials');
    Route::get('/clinical-trials/map', [App\Http\Controllers\Index\ClinicalTrialMapController::class, 'showMap'])->name('discover.clinicaltrials.map');
    Route::get('/clinical-trials/map/{country}', [App\Http\Controllers\Index\ClinicalTrialMapController::class, 'showCountry'])->name('discover.clinicaltrials.map.country');
    Route::get('/clinical-trials/{slug}', [App\Http\Controllers\Index\ClinicaltrialController::class, 'show'])->name('discover.clinicaltrials.show');

    // News Articles
    Route::get('/news', [App\Http\Controllers\Index\DataFeeds\NewsController::class, 'index'])->name('discover.news');

    // Listing Requests
    Route::get('/listing', [App\Http\Controllers\Index\ListingRequestController::class, 'index'])->name('listing');
    Route::get('/listing/request', [App\Http\Controllers\Index\ListingRequestController::class, 'request'])->name('listing.request');
    Route::get('/listing/request/getEntityListJson', [App\Http\Controllers\Index\ListingRequestController::class, 'getEntityListJson'])->name('listing.request.getEntityListJson');

    Route::get('/job-report-entry', [App\Http\Controllers\Index\JobReportEntryController::class, 'index'])->name('job-report-entry.index');
    Route::post('/job-report-entry', [App\Http\Controllers\Index\JobReportEntryController::class, 'store'])->name('job-report-entry.store');

    // Search
    Route::post('/search', [App\Http\Controllers\Index\SearchController::class, 'search'])->name('search');
    Route::get('/search/{term}', [App\Http\Controllers\Index\SearchController::class, 'index'])->where('term', '(.*)')
        ->name('search.index');

    Route::post('/search/organizations', [App\Http\Controllers\Index\SearchController::class, 'showOrganizationResults'])->name('search.organizations');
    Route::post('/search/organizations/{term}', [App\Http\Controllers\Index\SearchController::class, 'showOrganizationResults']);
    Route::get('/search/organizations/{term}', [App\Http\Controllers\Index\SearchController::class, 'showOrganizationResults']);

    Route::post('/search/people', [App\Http\Controllers\Index\SearchController::class, 'showPeopleResults'])->name('search.people');
    Route::post('/search/people/{term}', [App\Http\Controllers\Index\SearchController::class, 'showPeopleResults']);
    Route::get('/search/people/{term}', [App\Http\Controllers\Index\SearchController::class, 'showPeopleResults']);

    Route::post('/search/investors', [App\Http\Controllers\Index\SearchController::class, 'showInvestorResults'])->name('search.investors');
    Route::post('/search/investors/{term}', [App\Http\Controllers\Index\SearchController::class, 'showInvestorResults']);
    Route::get('/search/investors/{term}', [App\Http\Controllers\Index\SearchController::class, 'showInvestorResults']);

    Route::post('/search/research', [App\Http\Controllers\Index\SearchController::class, 'showResearchResults'])->name('search.research');
    Route::post('/search/research/{term}', [App\Http\Controllers\Index\SearchController::class, 'showResearchResults']);
    Route::get('/search/research/{term}', [App\Http\Controllers\Index\SearchController::class, 'showResearchResults']);

    Route::post('/search/locations', [App\Http\Controllers\Index\SearchController::class, 'showLocationResults'])->name('search.locations');
    Route::post('/search/locations/{term}', [App\Http\Controllers\Index\SearchController::class, 'showLocationResults']);
    Route::get('/search/locations/{term}', [App\Http\Controllers\Index\SearchController::class, 'showLocationResults']);

    Route::post('/search/focus', [App\Http\Controllers\Index\SearchController::class, 'showFocusResults'])->name('search.focus');
    Route::post('/search/focus/{term}', [App\Http\Controllers\Index\SearchController::class, 'showFocusResults']);
    Route::get('/search/focus/{term}', [App\Http\Controllers\Index\SearchController::class, 'showFocusResults']);

    Route::post('/search/events', [App\Http\Controllers\Index\SearchController::class, 'showEventResults'])->name('search.events');
    Route::post('/search/events/{term}', [App\Http\Controllers\Index\SearchController::class, 'showEventResults']);
    Route::get('/search/events/{term}', [App\Http\Controllers\Index\SearchController::class, 'showEventResults']);

    Route::post('/search/jobs', [App\Http\Controllers\Index\SearchController::class, 'showJobResults'])->name('search.jobs');
    Route::post('/search/jobs/{term}', [App\Http\Controllers\Index\SearchController::class, 'showJobResults']);
    Route::get('/search/jobs/{term}', [App\Http\Controllers\Index\SearchController::class, 'showJobResults']);

    Route::post('/search/clinicaltrials', [App\Http\Controllers\Index\SearchController::class, 'showClinicalTrialsResults'])->name('search.clinicaltrials');
    Route::get('/search/clinicaltrials/{term}', [App\Http\Controllers\Index\SearchController::class, 'showClinicalTrialsResults'])->name('search.clinicaltrials.term');

//    Route::get('/patents', 'Index\PatentController@index')->name('discover.patents');
//    Route::get('/patent-tracker', 'Index\PatentController@index')->name('discover.patents.tracker');
//    Route::get('/patent-filings', 'Index\DataFeeds\PatentFilingController@index')->name('discover.patents.filings');

    //Insights main page
    Route::prefix('/insights')->name('discover.')->group(function () {
        Route::get('/', [App\Http\Controllers\Index\InsightsController::class, 'index'])->name('insights');
        Route::get('/request', [App\Http\Controllers\Index\InsightsController::class, 'request'])->name('insights.request');
        Route::post('/request', [App\Http\Controllers\Index\InsightsController::class, 'saveRequest'])->name('insights.saveRequest');
    });

    //Insights
    Route::prefix('/insights')->name('insights.')->group(function () {
        Route::get('/companies-by-type', [App\Http\Controllers\Insights\CompaniesByTypeController::class, 'index'])->name('companies-by-type');
        Route::get('/top-ten-locations', [App\Http\Controllers\Insights\TopTenLocationsController::class, 'index'])->name('top-ten-locations');
        Route::get('/companies-by-focus-drug', [App\Http\Controllers\Insights\CompaniesByFocusDrug::class, 'index'])->name('companies-by-focus-drug');
        Route::get('/clinical-trial-tracker', [App\Http\Controllers\Insights\ClinicalTrialPipelineController::class, 'show'])->name('clinicaltrials.pipeline');
        Route::get('/market-comparison', [App\Http\Controllers\Insights\CompareMarketController::class, 'show'])->name('compare-market');
        Route::get('/jobs-by-focus', [App\Http\Controllers\Insights\JobsByFocusController::class, 'index'])->name('jobs-by-focus');
        Route::get('/jobs-by-type', [App\Http\Controllers\Insights\JobsByTypeController::class, 'index'])->name('jobs-by-type');
        Route::get('/collaborators', [App\Http\Controllers\Insights\ClinicalTrialCollaboratorsListController::class, 'show'])->name('collaborators.show');
        Route::post('/collaborators/list', [App\Http\Controllers\Insights\ClinicalTrialCollaboratorsListController::class, 'index'])->name('collaborators');
        Route::get('/most-interest', [App\Http\Controllers\Insights\ClinicalTrialFocusListController::class, 'show'])->name('most-interest.show');
        Route::post('/most-interest/list', [App\Http\Controllers\Insights\ClinicalTrialFocusListController::class, 'index'])->name('most-interest');
        Route::get('/research-authors', [App\Http\Controllers\Insights\ResearchAuthorsController::class, 'index'])->name('research-authors');
        Route::get('/research-authors/widget', [App\Http\Controllers\Insights\ResearchAuthorsController::class, 'widget'])->name('research-authors.widget');
        Route::get('/research-organizations', [App\Http\Controllers\Insights\ResearchOrganizationsController::class, 'index'])->name('research-organizations');
        Route::get('/research-organizations/widget', [App\Http\Controllers\Insights\ResearchOrganizationsController::class, 'widget'])->name('research-organizations.widget');
        Route::get('/research-by-focus', [App\Http\Controllers\Insights\ResearchByFocus::class, 'index'])->name('research-by-focus');
        Route::get('/companies-by-focus-industry', [App\Http\Controllers\Insights\CompaniesByFocusIndustry::class, 'index'])->name('companies-by-focus-industry');
        Route::get('/location-top-by-jobs', [App\Http\Controllers\Insights\LocationTopByJobsController::class, 'index'])->name('location-top-by-jobs');
        Route::get('/clinical-trials/distribution/countries', [App\Http\Controllers\Insights\ClinicalTrialDistributionController::class, 'show'])->name('distribution.countries.show');
        Route::get('/clinical-trials/distribution/countries/focus', [App\Http\Controllers\Insights\ClinicalTrialDistributionController::class, 'showWithFocus'])->name('distribution.countries.focus.show');
        Route::get('/clinical-trials-historic', [App\Http\Controllers\Insights\ClinicalTrialHistoric::class, 'index'])->name('clinical-trials-historic');
        Route::get('/investment-funds', [App\Http\Controllers\Insights\InvestmentFundController::class, 'index'])->name('investment-funds');
        Route::get('/investment-funds/organization/{slug}', [App\Http\Controllers\Insights\InvestmentFundController::class, 'organizationChart'])->name('investment-funds.organization');
        Route::get('/non-profits', [App\Http\Controllers\Insights\NonProfitFocusController::class, 'chart'])->name('nonprofits.focus-chart');
        Route::get('/educational-organizations', [App\Http\Controllers\Insights\EducationalOrganizationsMapController::class, 'map'])->name('educational-organizations.map');
    });
});

// show entity routes with preview feature
Route::get('/organization/{slug}', [App\Http\Controllers\Index\CompanyController::class, 'show'])->name('discover.organizations.show');
Route::get('/person/{slug}', [App\Http\Controllers\Index\PersonController::class, 'show'])->name('discover.people.show');
// listing request routes with preview check
Route::post('/listing/request', [App\Http\Controllers\Index\ListingRequestController::class, 'submitRequest']);
Route::post('/listing/request/finish', [App\Http\Controllers\Index\ListingRequestController::class, 'finishRequest'])->name('listing.request.finish');

// Feedback
Route::middleware('spamprotection')->group(function () {
    Route::get('/feedback', [App\Http\Controllers\FeedbackController::class, 'create'])->name('feedback.create');
    Route::post('/feedback', [App\Http\Controllers\FeedbackController::class, 'store'])->name('feedback.store');

    Route::get('/request-demo', [App\Http\Controllers\FeedbackController::class, 'createDemoRequest'])->name('feedback.request-demo');
    Route::post('/request-demo', [App\Http\Controllers\FeedbackController::class, 'storeDemoRequest'])->name('feedback.store-demo');
});

/* Bookable Listings */
Route::middleware('spamprotection')->group(function () {
    Route::get('/care', [App\Http\Controllers\Index\BookableListingController::class, 'index'])->name('discover.bookable-listing.practitioners');
    Route::get('/care/{slug}', [App\Http\Controllers\Index\BookableListingController::class, 'show'])->name('discover.bookable-listing.show');
    Route::get('/add-care-listing', [App\Http\Controllers\Index\BookableListingController::class, 'create'])->name('discover.bookable-listing.create');

    Route::middleware('auth')->group(function () {
        Route::post('/care', [App\Http\Controllers\Index\BookableListingController::class, 'reservationRequest'])->name('discover.bookable-listing.reservation-request');
        Route::post('/add-care-listing', [App\Http\Controllers\Index\BookableListingController::class, 'store'])->name('discover.bookable-listing.store');
    });
});

/* MEMBER DASHBOARD */

Route::middleware('auth', 'verifiedIfAuthorized')->group(function () {
    Route::prefix('/dashboard')->group(function () {
        Route::get('/', [App\Http\Controllers\Dashboard\DashboardController::class, 'index'])->name('member.dashboard');
        Route::post('/updateWidgetsOrder', [App\Http\Controllers\Dashboard\DashboardController::class, 'updateWidgetsOrder'])->name('member.dashboard.updateWidgetsOrder');

        // Notes
        Route::get('/add-note', [App\Http\Controllers\Dashboard\NoteController::class, 'create'])->name('member.notes.create');
        Route::post('/add-note', [App\Http\Controllers\Dashboard\NoteController::class, 'store'])->name('member.notes.store');
        Route::post('/validate-note', [App\Http\Controllers\Dashboard\NoteController::class, 'checkSlug'])->name('member.notes.validate');
        Route::get('/edit-note/{slug}', [App\Http\Controllers\Dashboard\NoteController::class, 'edit'])->name('member.notes.edit');
        Route::get('/notes/{id}/destroy', [App\Http\Controllers\Dashboard\NoteController::class, 'destroy'])->name('member.notes.destroy');
        Route::post('/edit-note/{id}', [App\Http\Controllers\Dashboard\NoteController::class, 'update'])->name('member.notes.update');
        Route::get('/notes', [App\Http\Controllers\Dashboard\NoteController::class, 'index'])->name('member.notes.index');
        Route::get('/notes/{slug}', [App\Http\Controllers\Dashboard\NoteController::class, 'show'])->name('member.notes.show');

        // Follow lists
        Route::post('/follow-lists/ajax-store', [App\Http\Controllers\Dashboard\FollowListsController::class, 'ajaxStore'])->name('member.follow-lists.ajaxStore');
        Route::post('/follow-lists/validate-name', [App\Http\Controllers\Dashboard\FollowListsController::class, 'validateName'])->name('member.follow-lists.validateName');
        Route::resource('/follow-lists', 'App\Http\Controllers\Dashboard\FollowListsController', [
            'as' => 'member', ]);

        // Follow
        Route::resource('/follow', 'Dashboard\FollowController', [
            'as' => 'member', ]);
        Route::get('/follow//get-modal/{id}/{type}', [App\Http\Controllers\Dashboard\FollowController::class, 'getModal'])->name('member.follow.getModal');
        Route::post('/follow/attach', [App\Http\Controllers\Dashboard\FollowController::class, 'attach'])->name('member.follow.attach');
        Route::post('/follow/detach', [App\Http\Controllers\Dashboard\FollowController::class, 'detach'])->name('member.follow.detach');

        // Team
        Route::prefix('/team')->name('member.team.')->group(function () {
            Route::get('/', [App\Http\Controllers\Dashboard\TeamController::class, 'index'])->name('index');
            Route::post('/create', [App\Http\Controllers\Dashboard\TeamController::class, 'create'])->name('create');
            Route::post('/invite', [App\Http\Controllers\Dashboard\TeamController::class, 'invite'])->name('invite');
            Route::delete('/invitation/{invitation_id}', [App\Http\Controllers\Dashboard\TeamController::class, 'removeInvitation'])->name('removeInvitation');
            Route::delete('/member/{member_id}', [App\Http\Controllers\Dashboard\TeamController::class, 'removeMember'])->name('removeMember');

            Route::post('/{teamId}/leave', [App\Http\Controllers\Dashboard\TeamController::class, 'leaveTeam'])->name('leave');
        });
    });

    // Notifications
    //TODO change name to remove 'dashboard' and add name to un-named routes
    Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'index'])->name('dashboard.notifications.index');
    Route::get('/notifications/read', [App\Http\Controllers\NotificationController::class, 'setReadAll']);
    Route::get('/notifications/{notification}', [App\Http\Controllers\NotificationController::class, 'show'])->name('dashboard.notifications.show');
    Route::get('/notifications/{notification}/read', [App\Http\Controllers\NotificationController::class, 'setRead']);

    Route::get('/user/notifications', [App\Http\Controllers\NotificationController::class, 'getNotificationsByAuthedUser']);
    Route::get('/user/notifications/unread', [App\Http\Controllers\NotificationController::class, 'getUnreadNotificationsCountByAuthedUser']);

    // User Settings Page
    Route::get('/user/settings', [App\Http\Controllers\Index\UserProfileController::class, 'index'])->name('user.settings');
    Route::post('/user/settings', [App\Http\Controllers\Index\UserProfileController::class, 'update']);
    Route::get('/user/settings/email', [App\Http\Controllers\Index\UserEmailController::class, 'index'])->name('user.settings.email');
    Route::post('/user/settings/email', [App\Http\Controllers\Index\UserEmailController::class, 'update']);
    Route::get('/user/settings/password', [App\Http\Controllers\Index\UserPasswordController::class, 'index'])->name('user.settings.password');
    Route::post('/user/settings/password', [App\Http\Controllers\Index\UserPasswordController::class, 'update']);
    Route::post('/user/settings/validateurl', [App\Http\Controllers\Index\UserProfileController::class, 'checkMemberUrl'])->name('user.validate.member_url');
    Route::get('/user/settings/social', [App\Http\Controllers\Index\UserSocialController::class, 'index'])->name('user.settings.social');
    Route::get('/user/settings/social/connect/{provider}', [App\Http\Controllers\Index\UserSocialController::class, 'connect'])->name('user.settings.social.connect');
    Route::get('/user/settings/oauth', [App\Http\Controllers\Index\UserOauthController::class, 'index'])->name('user.settings.oauth');
    Route::post('/user/settings/oauth/{clientId}/disconnect', [App\Http\Controllers\Index\UserOauthController::class, 'disconnectClient'])->name('user.settings.oauth.disconnectClient');

    Route::get('/user/person/status', [App\Http\Controllers\Index\UserClaimPersonController::class, 'status'])->name('user.person.status');
    Route::get('/user/person/verify/email', [App\Http\Controllers\Index\UserClaimPersonController::class, 'verifyEmail'])->name('user.person.verify.email');
    Route::get('/user/person/verify/email/send', [App\Http\Controllers\Index\UserClaimPersonController::class, 'sendVerificationMail'])->name('user.person.verify.email.send');
    Route::get('/user/person/verify/email/{token}', [App\Http\Controllers\Index\UserClaimPersonController::class, 'verifyClaimByEmail'])->name('user.person.verify.email.check');
    Route::get('/user/person/verify/social', [App\Http\Controllers\Index\UserClaimPersonController::class, 'verifySocial'])->name('user.person.verify.social');
    Route::get('/user/person/verify/social/check', [App\Http\Controllers\Index\UserClaimPersonController::class, 'verifyClaimBySocial'])->name('user.person.verify.social.check');

    Route::get('/user/person', [App\Http\Controllers\Index\UserPersonController::class, 'index'])->name('user.person.index');
    Route::post('/user/person', [App\Http\Controllers\Index\UserPersonController::class, 'savePersonal'])->name('user.person.personal.save');
    Route::get('/user/person/email', [App\Http\Controllers\Index\UserPersonController::class, 'email'])->name('user.person.email');
    Route::post('/user/person/email', [App\Http\Controllers\Index\UserPersonController::class, 'saveEmail'])->name('user.person.email.save');
    Route::get('/user/person/social', [App\Http\Controllers\Index\UserPersonController::class, 'social'])->name('user.person.social');
    Route::post('/user/person/social', [App\Http\Controllers\Index\UserPersonController::class, 'saveSocial'])->name('user.person.social.save');

    Route::get('/user/person/create', [App\Http\Controllers\Index\UserPersonController::class, 'create'])->name('user.person.create');
    Route::post('/user/person/create/email', [App\Http\Controllers\Index\UserPersonController::class, 'storeBasicInformationShowEmailStep'])->name('user.person.email.store');
    Route::post('/user/person/create/social', [App\Http\Controllers\Index\UserPersonController::class, 'storeEmailShowSocialStep'])->name('user.person.social.store');
    Route::post('/user/person/create/finish', [App\Http\Controllers\Index\UserPersonController::class, 'storeSocialShowFinishStep'])->name('user.person.finish.store');

    Route::get('/user/person/search', [App\Http\Controllers\Index\UserPersonController::class, 'search'])->name('user.person.search');
});

// Enterprise Dashboard
Route::middleware('auth', 'enterprise.demo')->group(function () {
    Route::name('enterprise.')->prefix('/enterprise')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Enterprise\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard/combined-feed', [App\Http\Controllers\Enterprise\DashboardController::class, 'combinedFeedWidget'])->name('dashboard.combined-feed');
        Route::get('/dashboard/follows', [App\Http\Controllers\Enterprise\DashboardController::class, 'userFollowsWidget'])->name('dashboard.follows');
        Route::get('/dashboard/notes', [App\Http\Controllers\Enterprise\DashboardController::class, 'userNotesWidget'])->name('dashboard.notes');
        Route::get('/dashboard/recently-viewed', [App\Http\Controllers\Enterprise\DashboardController::class, 'userRecentlyViewedWidget'])->name('dashboard.recently-viewed');
        Route::get('/dashboard/team', [App\Http\Controllers\Enterprise\DashboardController::class, 'teamWidget'])->name('dashboard.team');
        Route::get('/dashboard/patents', [App\Http\Controllers\Enterprise\DashboardController::class, 'patentsWidget'])->name('dashboard.patents');
        Route::get('/dashboard/clinical-trials', [App\Http\Controllers\Enterprise\DashboardController::class, 'clinicalTrialsWidget'])->name('dashboard.clinical-trials');
        Route::get('/dashboard/jobs', [App\Http\Controllers\Enterprise\DashboardController::class, 'jobsWidget'])->name('dashboard.jobs');
        Route::get('/dashboard/events', [App\Http\Controllers\Enterprise\DashboardController::class, 'eventsWidget'])->name('dashboard.events');
        Route::get('/dashboard/filters', [App\Http\Controllers\Enterprise\DashboardController::class, 'filters'])->name('dashboard.filters');
        Route::post('/dashboard/save', [App\Http\Controllers\Enterprise\DashboardController::class, 'saveWidgets'])->name('dashboard.widgets.save');
        Route::get('/dashboard/template', [App\Http\Controllers\Enterprise\DashboardController::class, 'widgetTemplate'])->name('dashboard.template');
        Route::get('/dashboard/leading-companies', [App\Http\Controllers\Enterprise\DashboardController::class, 'leadingCompaniesByClinicalTrials'])->name('dashboard.leading-companies-clinical-trials');
        Route::get('/dashboard/clinical-trials-completed', [App\Http\Controllers\Enterprise\DashboardController::class, 'clinicalTrialsCompleted'])->name('dashboard.clinical-trials-completed');

        //charts
        Route::get('/dashboard/charts/organizations-focus', [App\Http\Controllers\Enterprise\DashboardChartsController::class, 'organizationsFocusChart'])->name('dashboard.chart-organizations-focus');
        Route::get('/dashboard/charts/organizations-industry', [App\Http\Controllers\Enterprise\DashboardChartsController::class, 'organizationsIndustryChart'])->name('dashboard.chart-organizations-industry');
        Route::get('/dashboard/charts/job-demand', [App\Http\Controllers\Enterprise\DashboardChartsController::class, 'jobDemandChart'])->name('dashboard.chart-job-demand');
        Route::get('/dashboard/charts/active-patents', [App\Http\Controllers\Enterprise\DashboardChartsController::class, 'activePatentsChart'])->name('dashboard.chart-active-patents');
        Route::get('/dashboard/charts/clinical-trials', [App\Http\Controllers\Enterprise\DashboardChartsController::class, 'clinicalTrialsChart'])->name('dashboard.chart-clinical-trials-status');
        Route::get('/dashboard/charts/investments-by-focus', [App\Http\Controllers\Enterprise\DashboardChartsController::class, 'investmentByFocus'])->name('dashboard.chart-investments-by-focus');
        Route::get('/dashboard/charts/clinical-trials-focus', [App\Http\Controllers\Enterprise\DashboardChartsController::class, 'clinicalTrialsFocusChart'])->name('dashboard.chart-clinical-trials-focus');
        Route::get('/dashboard/charts/clinical-trials-locations', [App\Http\Controllers\Enterprise\DashboardChartsController::class, 'clinicalTrialsLocationsMap'])->name('dashboard.chart-clinical-trials-locations');

        Route::post('/dashboard/request/widget', [App\Http\Controllers\Enterprise\DashboardRequestsController::class, 'requestWidget'])->name('dashboard.request.widget');
        Route::post('/dashboard/request/clinical-trial-participating', [App\Http\Controllers\Enterprise\DashboardRequestsController::class, 'clinicalTrialParticipating'])->name('dashboard.request.clinicalTrialParticipating');
    });
});

// User Email Reset
Route::get('/user/retake/{token}', [App\Http\Controllers\Index\UserRetakeController::class, 'index'])->name('user.retake');

// Members public routes for sharing
Route::get('/members/{member_url}/lists/{slug}', [App\Http\Controllers\Dashboard\FollowListsController::class, 'showPublic'])->name('members.follow-lists.public');
Route::get('/members/{member_url}/{slug}', [App\Http\Controllers\Dashboard\NoteController::class, 'showPublic'])->name('members.public.note');

Route::prefix('embeds')->name('embeds.')->group(function () {
    Route::get('/jobs', [App\Http\Controllers\Index\JobController::class, 'embedIndex'])->name('jobs.index');
    Route::get('/events', [App\Http\Controllers\Index\EventController::class, 'embedIndex'])->name('events.index');
});

Route::get('/js/external/embedSearch/template/{code}', [App\Http\Controllers\ExternalScriptController::class, 'getSearchModalTemplate'])->name('js.embedSearch.template');

//SPECIAL ADMIN ROUTES
require __DIR__.'/admin.php';

/* CATCH-ALL ROUTE for Backpack/PageManager - needs to be at the end of your routes.php file  **/
Route::get('{page}', [\App\Http\Controllers\PageController::class, 'index'])
    ->where(['page' => '^(((?=(?!admin))(?=(?!\/)).))*$'])
    ->name('page');
