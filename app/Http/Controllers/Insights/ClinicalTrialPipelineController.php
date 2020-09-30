<?php

namespace App\Http\Controllers\Insights;

use App\Http\Controllers\Controller;
use App\Models\Clinicaltrial;
use App\Models\ClinicaltrialPhase;
use App\Models\Focus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClinicalTrialPipelineController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request) {

        $query = $this->getQuery();

        $path = route('insights.clinicaltrials.pipeline');
        $filters_focus = [];
        $filters_organizations = [];
        $filters_status = [];
        $filters_phases = [];
        $filters_researchers = [];
        $filters_conditions = [];
        $filters_interventions = [];

        if ($request->has('filter')) {
            $filterInput = $request->input('filter');
            $filter = array_map(function ($entity) {
                    return explode('|', $entity);
                }, $filterInput);

            $query = $this->filterQuery($query, $filter);

            if(isset($filter['focus'])) {
                $filters_focus = $filter['focus'];
            }

            if(isset($filter['company'])) {
                $filters_organizations = $filter['company'];
            }

            if(isset($filter['status'])) {
                $filters_status = $filter['status'];
            }

            if(isset($filter['phase'])) {
                $filters_phases = $filter['phase'];
            }

            if(isset($filter['researchers'])) {
                $filters_researchers = $filter['researchers'];
            }

            if(isset($filter['conditions'])) {
                $filters_conditions = $filter['conditions'];
            }

            if(isset($filter['interventions'])) {
                $filters_interventions = $filter['interventions'];
            }
        }

        $sort = $request->has('sort') ? $request->input('sort') : 'organizations';
        $companies = $this->sortQuery($query, $sort)->get()->groupBy('company_id');

        $focus_cats = Focus::whereHas('clinicaltrials')->orderBy('name')->pluck('name')->unique();
        $status = Clinicaltrial::orderBy('status')->pluck('status')->unique();
        $phases = ClinicaltrialPhase::orderBy('integer')->pluck('pretty_name')->unique();

        return view('discover.insights.clinicaltrials.show', compact(
            'companies',
            'focus_cats',
            'path',
            'filters_focus',
            'filters_organizations',
            'filters_status',
            'filters_phases',
            'filters_researchers',
            'filters_conditions',
            'filters_interventions',
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
                'clinicaltrials.phases as phase_value', 'clinicaltrials.phase_integer as phase_integer',
                'clinicaltrials.status as status', 'clinicaltrials.conditions as conditions',
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

        $query->orderBy($orderField, $direction);

        if ($sortType === 'organizations') {
            $query->orderBy('phase_integer', 'desc');
        }

        return $query;
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

        if(isset($filter['researchers'])) {
            $query = $this->filterByResearchers($query, $filter['researchers']);
        }

        if(isset($filter['conditions'])) {
            $query = $this->filterByConditions($query, $filter['conditions']);
        }

        if(isset($filter['interventions'])) {
            $query = $this->filterByInterventions($query, $filter['interventions']);
        }

        return $query;
    }

    private function filterByFocus($query, $params)
    {
        return $query->whereIn('focus.name', $params);
    }

    private function filterByOrganizations($query, $params)
    {
        return $query->whereIn('companies.name', $params);
    }

    private function filterByStatus($query, $params)
    {
        return $query->whereIn('clinicaltrials.status', $params);
    }

    private function filterByPhase($query, $params)
    {
        return $query->whereIn('clinicaltrials.phases', $params);
    }

    private function filterByResearchers($query, $params)
    {
        return $query
            ->join('clinicaltrial_person', 'clinicaltrials.id', 'clinicaltrial_person.clinicaltrial_id')
            ->join('people', 'people.id', 'clinicaltrial_person.person_id')
            ->whereIn('people.name', $params);
    }

    private function filterByConditions($query, $params)
    {
        return $query->whereIn('clinicaltrials.conditions', $params);
    }

    private function filterByInterventions($query, $params)
    {
        return $query->whereIn('clinicaltrials.interventions', $params);
    }
}
