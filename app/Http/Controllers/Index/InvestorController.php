<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Repositories\FollowRepository;
use Illuminate\Http\Request;
use App\Models\Investor;
use App\Models\Location;
use App\Services\Metas;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\AllowedFilter;
use Auth;
use App\Services\StringLengthSort;

class InvestorController extends Controller
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

    // Index
    public function index(Request $request) {

        // Get Investors
        $investors = QueryBuilder::for(Investor::class)
            ->with('companies')
            ->allowedFilters([
                'name', 'type',
                AllowedFilter::partial('locations', 'locations.name'),
                AllowedFilter::partial('people', 'people.name'),
                AllowedFilter::partial('company', 'companies.name'),
            ])
            ->defaultSort('name')
            ->allowedSorts([
                'name', 'type',
                AllowedSort::custom('thisIsATest', new StringLengthSort(), 'name'),
            ])
            ->paginate(12)
            ->appends(request()->query());

        $types = Investor::pluck('type')->unique()->sort();

        $locations = Location::has('investors', '>' , 0)->with('investors')->get()->pluck('country')->unique()->sort();

        $metas = Metas::fromPage($request->path());

        // Return View
        return view('discover.investors.index', compact('investors', 'types', 'metas', 'locations'));

    }

    // Show
    public function show(Request $request, $slug) {

        // Get Investor
        $investor = Investor::where('slug', $slug)->firstOrFail();

        $metas = Metas::process(array(
            'title'         => $investor->name,
            'description'   => '',
            'image'         => '',
        ));

        $entity = 'investors';
        $isFollowed = (bool) count(FollowRepository::fromuser(Investor::class, $investor->id));

        // Log Activity
        activity('pageview')
            ->causedBy(Auth::user())
            ->withProperties([
                'ip' => $request->ip(),
                'entity' => 'investors',
                'slug' => $investor->slug,
                'image' => $investor->logo
            ])
            ->performedOn($investor)
            ->log($investor->name);

        return view('discover.investors.show', compact('investor', 'metas', 'entity', 'isFollowed'));
    }

    public function namesJson()
    {
        return response()->json(Investor::all()->pluck('name'));
    }
}
