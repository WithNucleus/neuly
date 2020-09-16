<?php

namespace App\Http\Controllers\Insights;

use App\Helpers\InsightsHelper;
use App\Http\Controllers\Controller;
use App\Models\Clinicaltrial;
use App\Models\ClinicaltrialPhase;
use App\Models\Company;
use App\Models\Focus;
use Backpack\CRUD\app\Library\CrudPanel\Traits\Query;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class ClinicalTrialPipelineController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return view
     */
    public function show(Request $request) {

        $query = $this->getQuery();

        $path = route('insights.clinicaltrials.pipeline');
        $filters_focus = [];
        $filters_organizations = [];
        $filters_status = [];
        $filters_phases = [];

        $sort = $request->has('sort') ? $request->input('sort') : 'organizations';
        $sortBy = 'company_name';
        $order = 'asc';

        if ($request->has('sort')) {

            if ($request->input('sort') == 'organizations') {
                $order = 'asc';
                $sortBy = 'company_name';
            } elseif($request->input('sort') == '-organizations') {
                $order = 'desc';
                $sortBy = 'company_name';
            }

            if ($request->input('sort') == 'status') {
                $order = 'asc';
                $sortBy = 'status';
            } elseif($request->input('sort') == '-status') {
                $order = 'desc';
                $sortBy = 'status';
            }

            if ($request->input('sort') == 'phase') {
                $order = 'asc';
                $sortBy = 'phase_integer';
            } elseif($request->input('sort') == '-phase') {
                $order = 'desc';
                $sortBy = 'phase_integer';
            }

        }

        if ($request->has('filter'))
        {
            $filter = $request->input('filter');
            $query = $this->filterQuery($query, $filter);

            if(isset($filter['focus'])) {
                $filters_focus = $this->getEntityNameArray($filter['focus']);
            }

            if(isset($filter['company'])) {
                $filters_organizations = $this->getEntityNameArray($filter['company']);
            }

            if(isset($filter['status'])) {
                $filters_status = $this->getEntityNameArray($filter['status']);
            }

            if(isset($filter['phase'])) {
                $filters_phases = $this->getEntityNameArray($filter['phase']);
            }
        }

        $sort  = $request->has('sort') ? $request->input('sort') : 'organizations';
        $companies = $this->sortQuery($query, $sort)->get()->groupBy('company_id');

        $focus_cats = Focus::has('clinicaltrials', '>' , 0)->get()->pluck('name')->unique()->sort();

        $status = Clinicaltrial::pluck('status')->unique()->sort();

        $phases = ClinicaltrialPhase::orderBy('integer')->pluck('pretty_name')->unique();

        return view('discover.insights.clinicaltrials.show', compact(
            'companies',
            'focus_cats',
            'path',
            'filters_focus',
            'filters_organizations',
            'filters_status',
            'filters_phases',
            'sort',
            'status',
            'phases'
        ));
    }

    private function getQuery()
    {
        return DB::table('companies')
            ->join('clinicaltrial_company', 'companies.id', 'clinicaltrial_company.company_id')
            ->join('clinicaltrials', 'clinicaltrials.id', 'clinicaltrial_company.clinicaltrial_id')
            ->join('clinicaltrial_focus', 'clinicaltrials.id', 'clinicaltrial_focus.clinicaltrial_id')
            ->join('focus', 'focus.id', 'clinicaltrial_focus.focus_id')
            ->select('companies.id as company_id', 'companies.name as company_name', 'companies.slug as company_slug',
                'clinicaltrials.id as clinicaltrial_id', 'clinicaltrials.title as title', 'clinicaltrials.slug as slug',
                'clinicaltrials.phases as phase_value', 'clinicaltrials.phase_integer as phase_integer', 'clinicaltrials.status as status',
                'clinicaltrials.conditions as conditions',
                'focus.id as focus_id', 'focus.name as focus_name', 'focus.slug as focus_slug');
    }

    private function sortQuery($query, $sort)
    {
        $direction = strpos($sort, '-') !== false ? 'desc' : 'asc';
        $sortType = str_replace('-', '', $sort);

        switch ($sortType) {
            case 'status':
                $orderField = 'status';
                break;
            case 'phase':
                $orderField = 'phase_integer';
                break;
            case 'organizations':
            default:
                $orderField = 'company_name';
                break;
        }

        if ($sortType === 'organizations') {
            return $query->orderBy($orderField, $direction)->orderBy('phase_integer', 'desc');
        } else {
            return $query->orderBy('company_name', 'asc')->orderBy($orderField, $direction);
        }
    }

    private function filterQuery($query, $filter)
    {
        if(isset($filter['focus']))
        {
            $query = $this->filterByFocus($query, $filter['focus']);
        }

        if(isset($filter['company']))
        {
            $query = $this->filterByOrganizations($query, $filter['company']);
        }

        if(isset($filter['status']))
        {
            $query = $this->filterByStatus($query, $filter['status']);
        }

        if(isset($filter['phase']))
        {
            $query = $this->filterByPhase($query, $filter['phase']);
        }

        return $query;
    }

    private function filterByFocus($query, $focus)
    {
        return $query->whereIn('focus.name', $this->getEntityNameArray($focus));
    }

    private function filterByOrganizations($query, $organizations)
    {
        return $query->whereIn('companies.name', $this->getEntityNameArray($organizations));
    }

    private function filterByStatus($query, $status)
    {
        return $query->whereIn('clinicaltrials.status', $this->getEntityNameArray($status));
    }

    private function filterByPhase($query, $phase)
    {
        return $query->whereIn('clinicaltrials.phases', $this->getEntityNameArray($phase));
    }

    private function getEntityNameArray($entity) {
        return explode('|', $entity);
    }
}
