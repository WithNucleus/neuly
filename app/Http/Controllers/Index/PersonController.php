<?php

namespace App\Http\Controllers\Index;

use App\Helpers\ClaimPersonHelper;
use App\Helpers\NotificationHelper;
use App\Helpers\PagePreviewHelper;
use App\Http\Controllers\Controller;
use App\Http\Filters\PeopleCompanyFocusFilter;
use App\Mail\VerifyClaimedPersonMail;
use App\Models\Company;
use App\Models\Location;
use App\Models\Person;
use App\Models\RaisedClaim;
use App\Notifications\PersonDeletionRequested;
use App\Notifications\RaisedClaimCreated;
use App\Repositories\FollowRepository;
use App\Services\Metas;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Spatie\Activitylog\Models\Activity;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class PersonController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('query_filters')->only('index');
    }

    // Public / Private Index for Homepage
    public function index(Request $request)
    {
        $metas = Metas::fromPage($request->path());

        $people = QueryBuilder::for(Person::class)
            ->public()
            ->with('companies')
            ->allowedFilters([
                'name',
                AllowedFilter::partial('locations', 'locations.name'),
                AllowedFilter::partial('company', 'companies.name'),
                AllowedFilter::scope('is_investor', 'hasInvestors'),
                AllowedFilter::callback('with_email', function (Builder $query, $value) {
                    $query->whereNotNull('email');
                }),
                AllowedFilter::custom('focus', new PeopleCompanyFocusFilter),
            ])
            ->defaultSort('-created_at')
            ->allowedSorts([
                'name',
                AllowedSort::field('date', 'created_at'),
            ])
            ->paginate(25)
            ->appends(request()->query());

        $locations = Location::has('people')->with('people')->get()->pluck('country')->unique()->sort()->toArray();
        $companiesWithFocus = Company::has('people')->has('focus')->with('focus')->get();
        $focuses = [];

        foreach ($companiesWithFocus as $company) {
            foreach ($company->focus as $focus) {
                $focuses[] = $focus->name;
            }
        }

        $focuses = array_unique($focuses);
        sort($focuses);

        if ($request->has('filter')) {
            $filterInput = $request->input('filter');

            $filter = array_map(function ($entity) {
                return explode('|', $entity);
            }, $filterInput);
        }

        $filters_companies = $filter['company'] ?? [];
        $filters_focuses = $filter['focus'] ?? [];

        // Return View
        return view('discover.people.index', compact(
            'people',
            'metas',
            'locations',
            'focuses',
            'filters_companies',
            'filters_focuses',
        ));
    }

    // Show More Info -- Full Layout
    public function show(Request $request, $slug)
    {
        // Get Person
        $person = Person::where('slug', $slug)
            ->with([
                'content',
                'companies',
                'focus',
                'locations',
                'investors',
                'research',
                'events',
                'clinicaltrials',
            ])
            ->firstOrFail();

        $preview = $request->input('preview');
        // Check Visibility
        $previewResult = PagePreviewHelper::checkEntityPreview($request, $person);

        if ($previewResult['canView'] === false) {
            if ($previewResult['redirectToRoute']) {
                return redirect()->route($previewResult['redirectToRoute']);
            }

            abort(404);
        }

        $metas = Metas::process([
            'title' => $person->name,
            'description' => $person->bio,
            'image' => $person->entityImageUrl,
        ]);

        $entity = 'people';
        $isFollowed = (bool) count(FollowRepository::fromuser(Person::class, $person->id));
        $isVerified = $person->user_id !== null;

        // Log Activity
        activity('pageview')
            ->causedBy(Auth::user())
            ->withProperties([
                'ip' => $request->ip(),
                'entity' => 'people',
                'slug' => $person->slug,
            ])
            ->performedOn($person)
            ->tap(function (Activity $activity) use ($request) {
                $activity->ip = $request->ip();
            })
            ->log($person->name);

        return view('discover.people.show', compact('person', 'metas', 'entity', 'isFollowed', 'isVerified', 'preview'));
    }

    public function namesJson()
    {
        return response()->json(Person::all()->pluck('name'));
    }

    public function claim(Request $request, $slug)
    {
        $person = Person::where('slug', '=', $slug)->firstOrFail();
        $user = Auth::user();

        if ($user->hasRaisedClaimBefore()) {
            $request->session()->flash('error', 'You can only raise one claim at the same time.');

            return redirect()->route('discover.people.show', ['slug' => $person->slug]);
        }

        if (ClaimPersonHelper::canBeAutoClaimed($user, $person)) {
            ClaimPersonHelper::acceptClaim($user, $person);

            $request->session()->flash('success', 'Your claim was successfully granted.');

            return redirect()->route('user.person.index');
        }

        $comment = $request->input('comment');

        if ($person->email === null && $comment === null) {
            $request->session()->flash('error', 'You need to left comment to claim this person.');

            return redirect()->route('discover.people.show', ['slug' => $person->slug]);
        }

        $claim = new RaisedClaim();
        $claim->user_id = $user->id;
        $claim->person_id = $person->id;
        $claim->verification_token = RaisedClaim::generateToken();
        $claim->comment = $comment;
        $claim->save();

        $personEmails = $person->getEmails();

        if ($personEmails === []) {
            return redirect()->route('user.person.status')
                ->with('error', 'Your claim could not be verified via email. Please contact our support.');
        }

        Mail::to($personEmails)
            ->send(new VerifyClaimedPersonMail($claim, $person));

        $notification = new RaisedClaimCreated($claim);
        NotificationHelper::sendAdminNotifications($notification);

        $request->session()->flash('success', 'Your claim was raised.');

        return redirect()->route('discover.people.show', ['slug' => $person->slug]);
    }

    private function canUserViewPerson($person)
    {
        return $person->visibility === 'public' || Auth::check();
    }

    public function requestDeletion($slug)
    {
        $person = Person::where('slug', $slug)->firstOrFail();

        return view('discover.people.requestDeletion', compact('person'));
    }

    public function requestDeletionSubmit(Request $request, $slug)
    {
        $person = Person::where('slug', $slug)->firstOrFail();
        $name = $request->input('name');
        $email = $request->input('email');
        $cause = $request->input('cause');

        $notification = new PersonDeletionRequested($person, $name, $email, $cause);
        NotificationHelper::sendAdminNotifications($notification);

        return redirect()
            ->route('discover.people.show', $person->slug)
            ->with('success', 'Your deletion request sent successfully!');
    }
}
