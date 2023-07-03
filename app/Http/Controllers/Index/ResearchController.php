<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Models\Focus;
use App\Models\Research;
use App\Repositories\FollowRepository;
use App\Services\Metas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;

class ResearchController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $metas = Metas::fromPage($request->path());

        return view('discover.research.index', [
            'metas' => $metas
        ]);
    }

    public function show(Request $request, $slug): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        // Get Research
        $research = Research::where('slug', $slug)->firstOrFail();

        $metas = Metas::process([
            'title' => $research->name,
            'description' => $research->abstract,
            'image' => '',
        ]);

        $related = $this->getReltaedEntities($research);

        $entity = 'research';
        $isFollowed = (bool) count(FollowRepository::fromuser(Research::class, $research->id));

        $resources = json_decode($research->resources);

        // Log Activity
        activity('pageview')
            ->causedBy(Auth::user())
            ->withProperties([
                'ip' => $request->ip(),
                'entity' => 'research',
                'slug' => $research->slug,
            ])
            ->performedOn($research)
            ->tap(function (Activity $activity) use ($request) {
                $activity->ip = $request->ip();
            })
            ->log($research->name);

        return view('discover.research.show', compact('research', 'related', 'metas', 'entity', 'resources', 'isFollowed'));
    }

    public function namesJson()
    {
        return response()->json(Research::all()->pluck('name'));
    }

    private function getReltaedEntities(Research $research)
    {
        $focuses = $research->focus->pluck('id');

        $relatedIds = DB::table('focus_research')
            ->select(['research_id', DB::raw('COUNT(research_id) as accurance')])
            ->whereIn('focus_id', $focuses)
            ->where('research_id', '!=', $research->id)
            ->groupBy('research_id')
            ->orderBy('accurance', 'desc')
            ->take(6)
            ->get()->pluck('research_id');

        $entities = Research::whereIn('id', $relatedIds)->get();

        return $entities;
    }
}
