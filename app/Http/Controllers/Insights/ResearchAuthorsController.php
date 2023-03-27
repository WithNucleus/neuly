<?php

namespace App\Http\Controllers\Insights;

use App\Http\Controllers\Controller;
use App\Models\Focus;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ResearchAuthorsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $sort = $request->has('sort') ? $request->input('sort') : 'desc';
        $currentFilters = [];

        $query = $this->getQuery();

        if ($request->has('filter')) {
            $currentFilters = $this->getFiltersArray($request->input('filter'));
            $query = $this->filterQuery($query, $currentFilters);
        }

        $data = $query->orderBy('total', $sort)
            ->paginate(15)
            ->appends($request->only(['sort', 'filter']));

        $focusesFilter = Focus::whereHas('research')->get()->pluck('name')->sort();
        $path = route('insights.research-authors');

        return view('discover.insights.research-authors.index', compact('data', 'path', 'sort', 'currentFilters', 'focusesFilter'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function widget(Request $request)
    {
        $data = $this->getQuery()
            ->orderBy('total', 'desc')
            ->take(10)
            ->get();

        if ($data) {
            $maxTotal = $data[0]->total;

            foreach ($data as $key => $item) {
                $data[$key]->percent = round(round($item->total / $maxTotal, 2) * 100 / 5);
                $data[$key]->link = route('discover.people.show', $item->slug);
            }
        }

        return response()->json($data, Response::HTTP_OK);
    }

    /**
     * @return \Illuminate\Database\Query\Builder
     */
    private function getQuery()
    {
        return DB::table('person_research')
            ->select([
                'people.id', 'people.name', 'people.slug',
                DB::raw('COUNT(person_research.research_id) AS total'),
            ])
            ->join('people', 'people.id', '=', 'person_research.person_id')
            ->groupBy('people.id');
    }

    /**
     * @param  string  $filter
     * @return array
     */
    private function getFiltersArray($filter)
    {
        $filtersArray = [];

        if (isset($filter['focus'])) {
            $filtersArray['focus'] = explode('|', $filter['focus']);
        }

        return $filtersArray;
    }

    /**
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  array  $filter
     * @return \Illuminate\Database\Query\Builder
     */
    private function filterQuery($query, $filter)
    {
        if (isset($filter['focus'])) {
            $query = $this->filterByFocus($query, $filter['focus']);
        }

        return $query;
    }

    /**
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  array  $focusNames
     * @return mixed
     */
    private function filterByFocus($query, $focusNames)
    {
        $subquery = DB::table('focus_research')
            ->select('research_id')
            ->whereIn('focus_id', Focus::select('id')->whereIn('name', $focusNames));

        return $query->whereIn('person_research.research_id', $subquery);
    }
}
