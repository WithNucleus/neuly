<?php

namespace App\Http\Controllers\Index;

use App\Helpers\ClaimPersonHelper;
use App\Helpers\NotificationHelper;
use App\Helpers\PagePreviewHelper;
use App\Http\Controllers\Controller;
use App\Mail\VerifyClaimedPersonMail;
use App\Models\Person;
use App\Models\RaisedClaim;
use App\Notifications\PersonDeletionRequested;
use App\Notifications\RaisedClaimCreated;
use App\Repositories\FollowRepository;
use App\Services\Metas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Spatie\Activitylog\Models\Activity;

class PersonController extends Controller
{

    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $metas = Metas::fromPage($request->path());

        return view('discover.people.index', [
            'metas' => $metas
        ]);
    }

    public function show(Request $request, $slug): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
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
                'mediaItems'
            ])
            ->firstOrFail();

        $userIsPerson = false;

        if ($person->user_id) {
            if (Auth::id() === $person->user_id) {
                $userIsPerson = true;
            }
        }

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

        $entity = $person;
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

        return view('discover.people.show', compact('person', 'metas', 'entity', 'isVerified', 'preview', 'userIsPerson'));
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
