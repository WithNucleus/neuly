<?php

namespace App\Http\Controllers\Index;

use App\Enum\MediaTypes;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Focus;
use App\Models\Patent;
use App\Models\Person;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PatentController extends Controller
{
    public function __construct()
    {
        $this->middleware('query_filters')->only(['index', 'tracker']);
    }

    public function index()
    {
        $patents = $this->getPatentsQuery()
            ->defaultSort('-priority_date')
            ->paginate(10)
            ->appends(request()->query());

        $focusCategories = $this->getFocusFilters();
        $patentStatuses = $this->getStatusFilters();
        $people = $this->getPeopleFilters();
        $organizations = $this->getOrganizationFilters();

        return view('discover.patents.index', compact('patents', 'focusCategories', 'patentStatuses', 'people', 'organizations'));
    }


    public function tracker() {
        $patents = $this->getPatentsQuery()
            ->defaultSort('-priority_date')
            ->paginate(300)
            ->appends(request()->query());

        $focusCategories = $this->getFocusFilters();
        $patentStatuses = $this->getStatusFilters();
        $people = $this->getPeopleFilters();
        $organizations = $this->getOrganizationFilters();

        return view('discover.patents.tracker', compact('patents', 'focusCategories', 'patentStatuses', 'people', 'organizations'));
    }

    private function getPatentsQuery(): QueryBuilder
    {
        return QueryBuilder::for(Patent::class)
            ->with([
                'companies',
                'people',
                'focus'
            ])->allowedSorts([
                'name',
                'priority_date',
                'granted_date',
                'expiration_date'
            ])
            ->allowedFilters([
                'status',
                AllowedFilter::partial('focus', 'focus.name'),
                AllowedFilter::partial('people', 'people.name'),
                AllowedFilter::partial('company', 'companies.name'),
            ]);
    }

    private function getFocusFilters(): array
    {
        return Focus::whereHas('patents')->orderBy('name')->pluck('name')->toArray();
    }

    private function getStatusFilters(): array
    {
        return [
            'Filed',
            'Pending',
            'Published',
            'Granted',
            'Abandoned',
            'Expired',
        ];
    }

    private function getPeopleFilters(): array
    {
        return Person::withCount(['patents'])->whereHas('patents')->orderBy('patents_count', 'desc')->pluck('name')->toArray();
    }

    private function getOrganizationFilters(): array
    {
        return Company::withCount(['patents'])->whereHas('patents')->orderBy('patents_count', 'desc')->pluck('name')->toArray();
    }
}
