<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Models\Clinicaltrial;
use App\Services\Metas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ClinicaltrialController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $metas = Metas::fromPage($request->path());

        return view('discover.clinicaltrials.index', [
            'metas' => $metas,
        ]);
    }

    public function show(Request $request, $slug): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $clinicalTrial = Clinicaltrial::with([
            'conditions',
            'interventions',
            'phases',
            'locations',
            'people',
            'companies',
        ])
            ->where('slug', $slug)
            ->firstOrFail();

        $entity = $clinicalTrial;

        // Log Activity
        activity('pageview')
            ->causedBy(Auth::user())
            ->withProperties([
                'ip' => $request->ip(),
                'entity' => 'clinicaltrials',
                'slug' => $clinicalTrial->slug,
            ])
            ->performedOn($clinicalTrial)
            ->tap(function (Activity $activity) use ($request) {
                $activity->ip = $request->ip();
            })
            ->log($clinicalTrial->title);

        return view('discover.clinicaltrials.show', [
            'clinicalTrial' => $clinicalTrial,
            'entity' => $entity
        ]);
    }
}
