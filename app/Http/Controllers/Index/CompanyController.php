<?php

namespace App\Http\Controllers\Index;

use App\Helpers\PagePreviewHelper;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Job;
use App\Repositories\FollowRepository;
use App\Services\Metas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;

class CompanyController extends Controller
{

    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $metas = Metas::fromPage($request->path());

        return view('discover.organizations.index', [
            'metas' => $metas
        ]);
    }

    public function show(Request $request, $slug): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $company = Company::with([
            'people',
            'locations',
            'investors',
            'jobs' => function ($query) {
                $query->open();
            },
            'events',
            'clinicaltrials',
            'parents',
            'subsidiaries',
            'valuations',
            'content',
        ])
            ->where('slug', $slug)
            ->firstOrFail();

        // Check Visibility
        $preview = $request->input('preview');
        $previewResult = PagePreviewHelper::checkEntityPreview($request, $company);

        if ($previewResult['canView'] === false) {
            if ($previewResult['redirectToRoute']) {
                return redirect()->route($previewResult['redirectToRoute']);
            }

            abort(404);
        }

        $metas = Metas::process([
            'title' => $company->name,
            'description' => $company->summary,
            'image' => $company->entityImageUrl,
        ]);

        $related = $this->getReltaedEntities($company);

        activity('pageview')
            ->causedBy(Auth::user())
            ->withProperties([
                'ip' => $request->ip(),
                'entity' => 'organizations',
                'slug' => $company->slug,
                'image' => $company->logo,
            ])
            ->performedOn($company)
            ->tap(function (Activity $activity) use ($request) {
                $activity->ip = $request->ip();
            })
            ->log($company->name);

        $entity = $company;

        return view('discover.organizations.show', compact('company', 'related', 'metas', 'entity', 'preview'));
    }

    public function namesJson(): \Illuminate\Http\JsonResponse
    {
        return response()->json(Company::all()->pluck('name'));
    }

    private function getReltaedEntities(Company $company)
    {
        $focuses = $company->focus->pluck('id');

        $relatedIds = DB::table('company_focus')
                        ->select(['company_id', DB::raw('COUNT(company_id) as accurance')])
                        ->whereIn('focus_id', $focuses)
                        ->where('company_id', '!=', $company->id)
                        ->groupBy('company_id')
                        ->orderBy('accurance', 'desc')
                        ->take(6)
                        ->get()->pluck('company_id');

        $entities = Company::whereIn('id', $relatedIds)->get();

        return $entities;
    }

    public function jobs($slug): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $owner = Company::where('slug', $slug)->firstOrFail();
        $jobs = Job::where('owner_id', $owner->id)->where('status', Job::STATUS_OPEN)->orderBy('posted_date', 'desc')->get();

        return view('discover.jobs.listing-by-owner', compact('owner', 'jobs'));
    }

    public function events($slug): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $company = Company::where('slug', $slug)->firstOrFail();
        $entity = 'organizations';

        return view('discover.organizations.events', compact('company', 'entity'));
    }
}
