<?php

use App\Http\Controllers\Auth;
use App\Http\Controllers\Content;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Dashboard\TeamController;
use App\Http\Controllers\Enterprise;
use App\Http\Controllers\ExternalScriptController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\Index;
use App\Http\Controllers\index;
use App\Http\Controllers\Index\UserOauthController;
use App\Http\Controllers\Insights;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\NotificationController;
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
    Route::get('login/{provider}', [Auth\LoginController::class, 'redirectToProvider'])->name('login.social');
    Route::get('login/{provider}/callback', [Auth\LoginController::class, 'handleProviderCallback']);
});

//TODO seems this method is not used anymore, check and remove
Route::get('/register/success', [Auth\MessagesController::class, 'registerSuccess'])->name('register.success');

Route::get('/invitation', [InvitationController::class, 'show'])->name('invitation.show');
Route::post('/invitation', [InvitationController::class, 'accept'])->name('invitation.accept');

Route::get('/', [Content\HomeController::class, 'index'])->name('index');
Route::get('/about', [Content\AboutController::class, 'index'])->name('about');

// Search Suggestions
Route::prefix('/searchassets')->name('searchassets.')->group(function () {
    Route::get('/everything.json', [Index\SearchSuggestionsController::class, 'everything'])->name('everything');
    Route::get('/researchAuthors.json', [Index\SearchSuggestionsController::class, 'researchAuthors'])->name('researchAuthors');
    Route::get('/investorsPeople.json', [Index\SearchSuggestionsController::class, 'investorsPeople'])->name('investorsPeople');
    Route::get('/investorsOrganizations.json', [Index\SearchSuggestionsController::class, 'investorsOrganizations'])->name('investorsOrganizations');
    Route::get('/companiesLocations.json', [Index\SearchSuggestionsController::class, 'companiesLocations'])->name('companiesLocations');
    Route::get('/peopleLocations.json', [Index\SearchSuggestionsController::class, 'peopleLocations'])->name('peopleLocations');
    Route::get('/investorsLocations.json', [Index\SearchSuggestionsController::class, 'investorsLocations'])->name('investorsLocations');
    Route::get('/locationsRegions.json', [Index\SearchSuggestionsController::class, 'locationsRegions'])->name('locationsRegions');
    Route::get('/focusOrganizations.json', [Index\SearchSuggestionsController::class, 'focusOrganizations'])->name('focusOrganizations');
    Route::get('/clinicalTrialCollaborators.json', [Index\SearchSuggestionsController::class, 'clinicalTrialCollaborators'])->name('clinicalTrialCollaborators');
    Route::get('/clinicalTrialResearchers.json', [Index\SearchSuggestionsController::class, 'clinicalTrialResearchers'])->name('clinicalTrialResearchers');
    Route::get('/clinicalTrialConditions.json', [Index\SearchSuggestionsController::class, 'clinicalTrialConditions'])->name('clinicalTrialConditions');
    Route::get('/clinicalTrialInterventions.json', [Index\SearchSuggestionsController::class, 'clinicalTrialInterventions'])->name('clinicalTrialInterventions');
    Route::get('/clinicalTrialOutcomeMeasures.json', [Index\SearchSuggestionsController::class, 'clinicalTrialOutcomeMeasures'])->name('clinicalTrialOutcomeMeasures');
    Route::get('/clinicalTrialStudyDesigns.json', [Index\SearchSuggestionsController::class, 'clinicalTrialStudyDesigns'])->name('clinicalTrialStudyDesigns');
    Route::get('/peopleOrganizations.json', [Index\SearchSuggestionsController::class, 'peopleOrganizations'])->name('peopleOrganizations');
});

//Other searches
Route::get('/organization/names.json', [Index\CompanyController::class, 'namesJson']);

// Non-Auth Gate
Route::get('/clinical-trials/recruiting', [Index\RecruitingClinicalTrialController::class, 'index'])->name('discover.clinicaltrials.recruiting');
Route::get('/videos', [Index\DataFeeds\VideoController::class, 'index'])->name('discover.videos');
Route::get('/podcasts', [Index\DataFeeds\PodcastController::class, 'index'])->name('discover.podcasts');
Route::get('/podcasts/{slug}', [Index\DataFeeds\PodcastController::class, 'show'])->name('discover.podcasts.show');
Route::get('/books', [Index\DataFeeds\BookController::class, 'index'])->name('discover.books');
Route::get('/courses', [Index\CourseController::class, 'index'])->name('discover.courses');

// Listing Requests
Route::get('/listing', [Index\ListingRequestController::class, 'index'])->name('listing');
Route::get('/listing/request', [Index\ListingRequestController::class, 'request'])->name('listing.request');
Route::post('/listing/request', [Index\ListingRequestController::class, 'submitRequest']);
Route::post('/listing/request/finish', [Index\ListingRequestController::class, 'finishRequest'])->name('listing.request.finish');
Route::get('/listing/request/getEntityListJson', [Index\ListingRequestController::class, 'getEntityListJson'])->name('listing.request.getEntityListJson');

//Global group for registered and verified users only
Route::middleware('verifiedIfAuthorized')->group(function () {
    Route::get('/psychedelic-index', [Content\IndexController::class, 'index'])->name('discover.index');

    // Companies
    Route::get('/organizations', [Index\CompanyController::class, 'index'])->name('discover.organizations');
    Route::get('/organization/map', [Index\CompanyMapController::class, 'showMap'])->name('discover.organizations.map');
    Route::get('/organization/map/{country}', [Index\CompanyMapController::class, 'showCountry'])->name('discover.organizations.map.country');
    Route::get('/organization/{slug}/jobs', [Index\CompanyController::class, 'jobs'])->name('discover.organizations.jobs');
    Route::get('/organization/{slug}/events', [Index\CompanyController::class, 'events'])->name('discover.organizations.events');

    // People
    Route::get('/people', [Index\PersonController::class, 'index'])->name('discover.people');
    Route::get('/people/names.json', [Index\PersonController::class, 'namesJson']);
    Route::post('/person/{slug}/claim', [Index\PersonController::class, 'claim'])->name('discover.people.claim');
    Route::get('/person/{slug}/requestDeletion', [Index\PersonController::class, 'requestDeletion'])->name('discover.people.requestDeletion');
    Route::post('/person/{slug}/requestDeletion', [Index\PersonController::class, 'requestDeletionSubmit']);

    // Research
    Route::get('/research', [Index\ResearchController::class, 'index'])->name('discover.research');
    Route::get('/research/names.json', [Index\ResearchController::class, 'namesJson']);
    Route::get('/research/{slug}', [Index\ResearchController::class, 'show'])->name('discover.research.show');

    // Investors
    Route::get('/investors', [Index\InvestorController::class, 'index'])->name('discover.investors');
    Route::get('/investor/names.json', [Index\InvestorController::class, 'namesJson']);
    Route::get('/investors/map', [Index\InvestorMapController::class, 'showMap'])->name('discover.investors.map');
    Route::get('/investors/map/{country}', [Index\InvestorMapController::class, 'showCountry'])->name('discover.investors.map.country');
    Route::get('/investor/{slug}', [Index\InvestorController::class, 'show'])->name('discover.investors.show');
    Route::get('/investor/{slug}/jobs', [Index\InvestorController::class, 'jobs'])->name('discover.investors.jobs');

    // Locations
    Route::get('/locations', [Index\LocationController::class, 'index'])->name('discover.locations');
    Route::get('/locations/map', [Index\LocationMapController::class, 'showMap'])->name('discover.locations.maps.global');
    Route::get('/locations/map/{country}', [Index\LocationMapController::class, 'showCountry'])->name('discover.locations.maps.country');
    Route::get('/locations/citynames.json', [Index\LocationController::class, 'citynames']);
    Route::get('/locations/countries.json', [Index\LocationController::class, 'countries']);
    Route::get('/location/{slug}', [Index\LocationController::class, 'show'])->name('discover.locations.show');

    // Focus
    Route::get('/focus', [Index\FocusController::class, 'index'])->name('discover.focus');
    Route::get('/focus/{slug}', [Index\FocusController::class, 'show'])->name('discover.focus.show');

    // Events
    Route::get('/events', [Index\EventController::class, 'index'])->name('discover.events');
    Route::get('/events/embed-widget', [Index\EventController::class, 'embedWidget'])->name('discover.events.embedWidget');
    Route::get('/past-events', [Index\EventController::class, 'past'])->name('discover.events.past');
    Route::get('/events/citynames.json', [Index\EventController::class, 'citynames']);
    Route::get('/events/names.json', [Index\EventController::class, 'namesJson']);
    Route::get('/events/{slug}', [Index\EventController::class, 'show'])->name('discover.events.show');

    // Jobs
    Route::get('/jobs', [Index\JobController::class, 'index'])->name('discover.jobs');
    Route::get('/archived-jobs', [Index\JobController::class, 'archive'])->name('discover.jobs-archive');
    Route::get('/jobs/embed-widget', [Index\JobController::class, 'embedWidget'])->name('discover.jobs.embedWidget');
    Route::get('/jobs/titles.json', [Index\JobController::class, 'titlesJson'])->name('discover.jobs.titlesJson');
    Route::get('/jobs/map', [Index\JobMapController::class, 'showMap'])->name('discover.jobs.map');
    Route::get('/jobs/map/{country}', [Index\JobMapController::class, 'showCountry'])->name('discover.jobs.map.country');
    Route::get('/jobs/{slug}', [Index\JobController::class, 'show'])->name('discover.jobs.show');
    Route::get('/jobs/apply/{slug}', [Index\JobApplicationController::class, 'index'])->name('discover.jobs.apply');
    Route::post('/jobs/apply', [Index\JobApplicationController::class, 'apply'])->name('discover.jobs.applyProcess');

    // Clinical trials
    Route::get('/clinical-trials', [Index\ClinicaltrialController::class, 'index'])->name('discover.clinicaltrials');
    Route::get('/clinical-trials/map', [Index\ClinicalTrialMapController::class, 'showMap'])->name('discover.clinicaltrials.map');
    Route::get('/clinical-trials/map/{country}', [Index\ClinicalTrialMapController::class, 'showCountry'])->name('discover.clinicaltrials.map.country');
    Route::get('/clinical-trials/{slug}', [Index\ClinicaltrialController::class, 'show'])->name('discover.clinicaltrials.show');

    // News Articles
    Route::get('/news', [Index\DataFeeds\NewsController::class, 'index'])->name('discover.news');

    // Listing Requests
    Route::get('/listing', [Index\ListingRequestController::class, 'index'])->name('listing');
    Route::get('/listing/request', [Index\ListingRequestController::class, 'request'])->name('listing.request');
    Route::get('/listing/request/getEntityListJson', [Index\ListingRequestController::class, 'getEntityListJson'])->name('listing.request.getEntityListJson');

    Route::get('/job-report-entry', [Index\JobReportEntryController::class, 'index'])->name('job-report-entry.index');
    Route::post('/job-report-entry', [Index\JobReportEntryController::class, 'store'])->name('job-report-entry.store');

    // Search
    Route::post('/search', [Index\SearchController::class, 'search'])->name('search');
    Route::get('/search/{term}', [Index\SearchController::class, 'index'])->where('term', '(.*)')
        ->name('search.index');

    Route::post('/search/organizations', [index\SearchController::class, 'showOrganizationResults'])->name('search.organizations');
    Route::post('/search/organizations/{term}', [Index\SearchController::class, 'showOrganizationResults']);
    Route::get('/search/organizations/{term}', [Index\SearchController::class, 'showOrganizationResults']);

    Route::post('/search/people', [index\SearchController::class, 'showPeopleResults'])->name('search.people');
    Route::post('/search/people/{term}', [Index\SearchController::class, 'showPeopleResults']);
    Route::get('/search/people/{term}', [Index\SearchController::class, 'showPeopleResults']);

    Route::post('/search/investors', [index\SearchController::class, 'showInvestorResults'])->name('search.investors');
    Route::post('/search/investors/{term}', [Index\SearchController::class, 'showInvestorResults']);
    Route::get('/search/investors/{term}', [Index\SearchController::class, 'showInvestorResults']);

    Route::post('/search/research', [index\SearchController::class, 'showResearchResults'])->name('search.research');
    Route::post('/search/research/{term}', [Index\SearchController::class, 'showResearchResults']);
    Route::get('/search/research/{term}', [Index\SearchController::class, 'showResearchResults']);

    Route::post('/search/locations', [index\SearchController::class, 'showLocationResults'])->name('search.locations');
    Route::post('/search/locations/{term}', [Index\SearchController::class, 'showLocationResults']);
    Route::get('/search/locations/{term}', [Index\SearchController::class, 'showLocationResults']);

    Route::post('/search/focus', [index\SearchController::class, 'showFocusResults'])->name('search.focus');
    Route::post('/search/focus/{term}', [Index\SearchController::class, 'showFocusResults']);
    Route::get('/search/focus/{term}', [Index\SearchController::class, 'showFocusResults']);

    Route::post('/search/events', [index\SearchController::class, 'showEventResults'])->name('search.events');
    Route::post('/search/events/{term}', [Index\SearchController::class, 'showEventResults']);
    Route::get('/search/events/{term}', [Index\SearchController::class, 'showEventResults']);

    Route::post('/search/jobs', [index\SearchController::class, 'showJobResults'])->name('search.jobs');
    Route::post('/search/jobs/{term}', [Index\SearchController::class, 'showJobResults']);
    Route::get('/search/jobs/{term}', [Index\SearchController::class, 'showJobResults']);

    Route::post('/search/clinicaltrials', [index\SearchController::class, 'showClinicalTrialsResults'])->name('search.clinicaltrials');
    Route::get('/search/clinicaltrials/{term}', [Index\SearchController::class, 'showClinicalTrialsResults'])->name('search.clinicaltrials.term');

//    Route::get('/patents', 'Index\PatentController@index')->name('discover.patents');
//    Route::get('/patent-tracker', 'Index\PatentController@index')->name('discover.patents.tracker');
//    Route::get('/patent-filings', 'Index\DataFeeds\PatentFilingController@index')->name('discover.patents.filings');

    //Insights main page
    Route::prefix('/insights')->name('discover.')->group(function () {
        Route::get('/', [Index\InsightsController::class, 'index'])->name('insights');
        Route::get('/request', [Index\InsightsController::class, 'request'])->name('insights.request');
        Route::post('/request', [Index\InsightsController::class, 'saveRequest'])->name('insights.saveRequest');
    });

    //Insights
    Route::prefix('/insights')->name('insights.')->group(function () {
        Route::get('/companies-by-type', [Insights\CompaniesByTypeController::class, 'index'])->name('companies-by-type');
        Route::get('/top-ten-locations', [Insights\TopTenLocationsController::class, 'index'])->name('top-ten-locations');
        Route::get('/companies-by-focus-drug', [Insights\CompaniesByFocusDrug::class, 'index'])->name('companies-by-focus-drug');
        Route::get('/clinical-trial-tracker', [Insights\ClinicalTrialPipelineController::class, 'show'])->name('clinicaltrials.pipeline');
        Route::get('/market-comparison', [Insights\CompareMarketController::class, 'show'])->name('compare-market');
        Route::get('/jobs-by-focus', [Insights\JobsByFocusController::class, 'index'])->name('jobs-by-focus');
        Route::get('/jobs-by-type', [Insights\JobsByTypeController::class, 'index'])->name('jobs-by-type');
        Route::get('/collaborators', [Insights\ClinicalTrialCollaboratorsListController::class, 'show'])->name('collaborators.show');
        Route::post('/collaborators/list', [Insights\ClinicalTrialCollaboratorsListController::class, 'index'])->name('collaborators');
        Route::get('/most-interest', [Insights\ClinicalTrialFocusListController::class, 'show'])->name('most-interest.show');
        Route::post('/most-interest/list', [Insights\ClinicalTrialFocusListController::class, 'index'])->name('most-interest');
        Route::get('/research-authors', [Insights\ResearchAuthorsController::class, 'index'])->name('research-authors');
        Route::get('/research-authors/widget', [Insights\ResearchAuthorsController::class, 'widget'])->name('research-authors.widget');
        Route::get('/research-organizations', [Insights\ResearchOrganizationsController::class, 'index'])->name('research-organizations');
        Route::get('/research-organizations/widget', [Insights\ResearchOrganizationsController::class, 'widget'])->name('research-organizations.widget');
        Route::get('/research-by-focus', [Insights\ResearchByFocus::class, 'index'])->name('research-by-focus');
        Route::get('/companies-by-focus-industry', [Insights\CompaniesByFocusIndustry::class, 'index'])->name('companies-by-focus-industry');
        Route::get('/location-top-by-jobs', [Insights\LocationTopByJobsController::class, 'index'])->name('location-top-by-jobs');
        Route::get('/clinical-trials/distribution/countries', [Insights\ClinicalTrialDistributionController::class, 'show'])->name('distribution.countries.show');
        Route::get('/clinical-trials/distribution/countries/focus', [Insights\ClinicalTrialDistributionController::class, 'showWithFocus'])->name('distribution.countries.focus.show');
        Route::get('/clinical-trials-historic', [Insights\ClinicalTrialHistoric::class, 'index'])->name('clinical-trials-historic');
        Route::get('/investment-funds', [Insights\InvestmentFundController::class, 'index'])->name('investment-funds');
        Route::get('/investment-funds/organization/{slug}', [Insights\InvestmentFundController::class, 'organizationChart'])->name('investment-funds.organization');
        Route::get('/non-profits', [Insights\NonProfitFocusController::class, 'chart'])->name('nonprofits.focus-chart');
        Route::get('/educational-organizations', [Insights\EducationalOrganizationsMapController::class, 'map'])->name('educational-organizations.map');
    });
});

// show entity routes with preview feature
Route::get('/organization/{slug}', [Index\CompanyController::class, 'show'])->name('discover.organizations.show');
Route::get('/person/{slug}', [Index\PersonController::class, 'show'])->name('discover.people.show');
// listing request routes with preview check
Route::post('/listing/request', [Index\ListingRequestController::class, 'submitRequest']);
Route::post('/listing/request/finish', [Index\ListingRequestController::class, 'finishRequest'])->name('listing.request.finish');

// Feedback
Route::middleware('spamprotection')->group(function () {
    Route::get('/feedback', [FeedbackController::class, 'create'])->name('feedback.create');
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

    Route::get('/request-demo', [FeedbackController::class, 'createDemoRequest'])->name('feedback.request-demo');
    Route::post('/request-demo', [FeedbackController::class, 'storeDemoRequest'])->name('feedback.store-demo');
});

/* Bookable Listings */
Route::middleware('spamprotection')->group(function () {
    Route::get('/care', [Index\BookableListingController::class, 'index'])->name('discover.bookable-listing.practitioners');
    Route::get('/care/{slug}', [Index\BookableListingController::class, 'show'])->name('discover.bookable-listing.show');
    Route::get('/add-care-listing', [Index\BookableListingController::class, 'create'])->name('discover.bookable-listing.create');

    Route::middleware('auth')->group(function () {
        Route::post('/care', [Index\BookableListingController::class, 'reservationRequest'])->name('discover.bookable-listing.reservation-request');
        Route::post('/add-care-listing', [Index\BookableListingController::class, 'store'])->name('discover.bookable-listing.store');
    });
});

/* MEMBER DASHBOARD */

Route::middleware('auth', 'verifiedIfAuthorized')->group(function () {
    Route::prefix('/dashboard')->group(function () {
        Route::get('/', [Dashboard\DashboardController::class, 'index'])->name('member.dashboard');
        Route::post('/updateWidgetsOrder', [Dashboard\DashboardController::class, 'updateWidgetsOrder'])->name('member.dashboard.updateWidgetsOrder');

        // Notes
        Route::get('/add-note', [Dashboard\NoteController::class, 'create'])->name('member.notes.create');
        Route::post('/add-note', [Dashboard\NoteController::class, 'store'])->name('member.notes.store');
        Route::post('/validate-note', [Dashboard\NoteController::class, 'checkSlug'])->name('member.notes.validate');
        Route::get('/edit-note/{slug}', [Dashboard\NoteController::class, 'edit'])->name('member.notes.edit');
        Route::get('/notes/{id}/destroy', [Dashboard\NoteController::class, 'destroy'])->name('member.notes.destroy');
        Route::post('/edit-note/{id}', [Dashboard\NoteController::class, 'update'])->name('member.notes.update');
        Route::get('/notes', [Dashboard\NoteController::class, 'index'])->name('member.notes.index');
        Route::get('/notes/{slug}', [Dashboard\NoteController::class, 'show'])->name('member.notes.show');

        // Follow lists
        Route::post('/follow-lists/ajax-store', [Dashboard\FollowListsController::class, 'ajaxStore'])->name('member.follow-lists.ajaxStore');
        Route::post('/follow-lists/validate-name', [Dashboard\FollowListsController::class, 'validateName'])->name('member.follow-lists.validateName');
        Route::resource('/follow-lists', 'Dashboard\FollowListsController', [
            'as' => 'member', ]);

        // Follow
        Route::resource('/follow', 'Dashboard\FollowController', [
            'as' => 'member', ]);
        Route::get('/follow//get-modal/{id}/{type}', [Dashboard\FollowController::class, 'getModal'])->name('member.follow.getModal');
        Route::post('/follow/attach', [Dashboard\FollowController::class, 'attach'])->name('member.follow.attach');
        Route::post('/follow/detach', [Dashboard\FollowController::class, 'detach'])->name('member.follow.detach');

        // Team
        Route::prefix('/team')->name('member.team.')->group(function () {
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
    Route::get('/notifications', [NotificationController::class, 'index'])->name('dashboard.notifications.index');
    Route::get('/notifications/read', [NotificationController::class, 'setReadAll']);
    Route::get('/notifications/{notification}', [NotificationController::class, 'show'])->name('dashboard.notifications.show');
    Route::get('/notifications/{notification}/read', [NotificationController::class, 'setRead']);

    Route::get('/user/notifications', [NotificationController::class, 'getNotificationsByAuthedUser']);
    Route::get('/user/notifications/unread', [NotificationController::class, 'getUnreadNotificationsCountByAuthedUser']);

    // User Settings Page
    Route::get('/user/settings', [Index\UserProfileController::class, 'index'])->name('user.settings');
    Route::post('/user/settings', [Index\UserProfileController::class, 'update']);
    Route::get('/user/settings/email', [Index\UserEmailController::class, 'index'])->name('user.settings.email');
    Route::post('/user/settings/email', [Index\UserEmailController::class, 'update']);
    Route::get('/user/settings/password', [Index\UserPasswordController::class, 'index'])->name('user.settings.password');
    Route::post('/user/settings/password', [Index\UserPasswordController::class, 'update']);
    Route::post('/user/settings/validateurl', [Index\UserProfileController::class, 'checkMemberUrl'])->name('user.validate.member_url');
    Route::get('/user/settings/social', [Index\UserSocialController::class, 'index'])->name('user.settings.social');
    Route::get('/user/settings/social/connect/{provider}', [Index\UserSocialController::class, 'connect'])->name('user.settings.social.connect');
    Route::get('/user/settings/oauth', [UserOauthController::class, 'index'])->name('user.settings.oauth');
    Route::post('/user/settings/oauth/{clientId}/disconnect', [UserOauthController::class, 'disconnectClient'])->name('user.settings.oauth.disconnectClient');

    Route::get('/user/person/status', [Index\UserClaimPersonController::class, 'status'])->name('user.person.status');
    Route::get('/user/person/verify/email', [Index\UserClaimPersonController::class, 'verifyEmail'])->name('user.person.verify.email');
    Route::get('/user/person/verify/email/send', [Index\UserClaimPersonController::class, 'sendVerificationMail'])->name('user.person.verify.email.send');
    Route::get('/user/person/verify/email/{token}', [Index\UserClaimPersonController::class, 'verifyClaimByEmail'])->name('user.person.verify.email.check');
    Route::get('/user/person/verify/social', [Index\UserClaimPersonController::class, 'verifySocial'])->name('user.person.verify.social');
    Route::get('/user/person/verify/social/check', [Index\UserClaimPersonController::class, 'verifyClaimBySocial'])->name('user.person.verify.social.check');

    Route::get('/user/person', [Index\UserPersonController::class, 'index'])->name('user.person.index');
    Route::post('/user/person', [Index\UserPersonController::class, 'savePersonal'])->name('user.person.personal.save');
    Route::get('/user/person/email', [Index\UserPersonController::class, 'email'])->name('user.person.email');
    Route::post('/user/person/email', [Index\UserPersonController::class, 'saveEmail'])->name('user.person.email.save');
    Route::get('/user/person/social', [Index\UserPersonController::class, 'social'])->name('user.person.social');
    Route::post('/user/person/social', [Index\UserPersonController::class, 'saveSocial'])->name('user.person.social.save');

    Route::get('/user/person/create', [Index\UserPersonController::class, 'create'])->name('user.person.create');
    Route::post('/user/person/create/email', [Index\UserPersonController::class, 'storeBasicInformationShowEmailStep'])->name('user.person.email.store');
    Route::post('/user/person/create/social', [Index\UserPersonController::class, 'storeEmailShowSocialStep'])->name('user.person.social.store');
    Route::post('/user/person/create/finish', [Index\UserPersonController::class, 'storeSocialShowFinishStep'])->name('user.person.finish.store');

    Route::get('/user/person/search', [Index\UserPersonController::class, 'search'])->name('user.person.search');
});

// Enterprise Dashboard
Route::middleware('auth', 'enterprise.demo')->group(function () {
    Route::name('enterprise.')->prefix('/enterprise')->group(function () {
        Route::get('/dashboard', [Enterprise\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard/combined-feed', [Enterprise\DashboardController::class, 'combinedFeedWidget'])->name('dashboard.combined-feed');
        Route::get('/dashboard/follows', [Enterprise\DashboardController::class, 'userFollowsWidget'])->name('dashboard.follows');
        Route::get('/dashboard/notes', [Enterprise\DashboardController::class, 'userNotesWidget'])->name('dashboard.notes');
        Route::get('/dashboard/recently-viewed', [Enterprise\DashboardController::class, 'userRecentlyViewedWidget'])->name('dashboard.recently-viewed');
        Route::get('/dashboard/team', [Enterprise\DashboardController::class, 'teamWidget'])->name('dashboard.team');
        Route::get('/dashboard/patents', [Enterprise\DashboardController::class, 'patentsWidget'])->name('dashboard.patents');
        Route::get('/dashboard/clinical-trials', [Enterprise\DashboardController::class, 'clinicalTrialsWidget'])->name('dashboard.clinical-trials');
        Route::get('/dashboard/jobs', [Enterprise\DashboardController::class, 'jobsWidget'])->name('dashboard.jobs');
        Route::get('/dashboard/events', [Enterprise\DashboardController::class, 'eventsWidget'])->name('dashboard.events');
        Route::get('/dashboard/filters', [Enterprise\DashboardController::class, 'filters'])->name('dashboard.filters');
        Route::post('/dashboard/save', [Enterprise\DashboardController::class, 'saveWidgets'])->name('dashboard.widgets.save');
        Route::get('/dashboard/template', [Enterprise\DashboardController::class, 'widgetTemplate'])->name('dashboard.template');
        Route::get('/dashboard/leading-companies', [Enterprise\DashboardController::class, 'leadingCompaniesByClinicalTrials'])->name('dashboard.leading-companies-clinical-trials');
        Route::get('/dashboard/clinical-trials-completed', [Enterprise\DashboardController::class, 'clinicalTrialsCompleted'])->name('dashboard.clinical-trials-completed');

        //charts
        Route::get('/dashboard/charts/organizations-focus', [Enterprise\DashboardChartsController::class, 'organizationsFocusChart'])->name('dashboard.chart-organizations-focus');
        Route::get('/dashboard/charts/organizations-industry', [Enterprise\DashboardChartsController::class, 'organizationsIndustryChart'])->name('dashboard.chart-organizations-industry');
        Route::get('/dashboard/charts/job-demand', [Enterprise\DashboardChartsController::class, 'jobDemandChart'])->name('dashboard.chart-job-demand');
        Route::get('/dashboard/charts/active-patents', [Enterprise\DashboardChartsController::class, 'activePatentsChart'])->name('dashboard.chart-active-patents');
        Route::get('/dashboard/charts/clinical-trials', [Enterprise\DashboardChartsController::class, 'clinicalTrialsChart'])->name('dashboard.chart-clinical-trials-status');
        Route::get('/dashboard/charts/investments-by-focus', [Enterprise\DashboardChartsController::class, 'investmentByFocus'])->name('dashboard.chart-investments-by-focus');
        Route::get('/dashboard/charts/clinical-trials-focus', [Enterprise\DashboardChartsController::class, 'clinicalTrialsFocusChart'])->name('dashboard.chart-clinical-trials-focus');
        Route::get('/dashboard/charts/clinical-trials-locations', [Enterprise\DashboardChartsController::class, 'clinicalTrialsLocationsMap'])->name('dashboard.chart-clinical-trials-locations');

        Route::post('/dashboard/request/widget', [Enterprise\DashboardRequestsController::class, 'requestWidget'])->name('dashboard.request.widget');
        Route::post('/dashboard/request/clinical-trial-participating', [Enterprise\DashboardRequestsController::class, 'clinicalTrialParticipating'])->name('dashboard.request.clinicalTrialParticipating');
    });
});

// User Email Reset
Route::get('/user/retake/{token}', [Index\UserRetakeController::class, 'index'])->name('user.retake');

// Members public routes for sharing
Route::get('/members/{member_url}/lists/{slug}', [Dashboard\FollowListsController::class, 'showPublic'])->name('members.follow-lists.public');
Route::get('/members/{member_url}/{slug}', [Dashboard\NoteController::class, 'showPublic'])->name('members.public.note');

Route::prefix('embeds')->name('embeds.')->group(function () {
    Route::get('/jobs', [Index\JobController::class, 'embedIndex'])->name('jobs.index');
    Route::get('/events', [Index\EventController::class, 'embedIndex'])->name('events.index');
});

Route::get('/js/external/embedSearch/template/{code}', [ExternalScriptController::class, 'getSearchModalTemplate'])->name('js.embedSearch.template');

//SPECIAL ADMIN ROUTES
require __DIR__.'/admin.php';

/* CATCH-ALL ROUTE for Backpack/PageManager - needs to be at the end of your routes.php file  **/
Route::get('{page}', [\App\Http\Controllers\PageController::class, 'index'])
    ->where(['page' => '^(((?=(?!admin))(?=(?!\/)).))*$'])
    ->name('page');
