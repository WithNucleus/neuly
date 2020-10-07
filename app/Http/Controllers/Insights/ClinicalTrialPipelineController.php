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

        $filters_focus = [];
        $filters_organizations = [];
        $filters_status = [];
        $filters_phases = [];
        $filters_researchers = [];
        $filters_conditions = [];
        $filters_interventions = [];
        $filters_outcome_measures = [];
        $filters_study_designs = [];

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

            if(isset($filter['outcome_measures'])) {
                $filters_outcome_measures = $filter['outcome_measures'];
            }

            if(isset($filter['study_designs'])) {
                $filters_study_designs = $filter['study_designs'];
            }
        }

        $sort = $request->has('sort') ? $request->input('sort') : 'organizations';
        $companies = $this->sortQuery($query, $sort)->get()->groupBy('company_id');

        $path = route('insights.clinicaltrials.pipeline');
        $focus_cats = Focus::whereHas('clinicaltrials')->orderBy('name')->pluck('name')->unique();
        $status = Clinicaltrial::orderBy('status')->pluck('status')->unique();
        $phases = ClinicaltrialPhase::orderBy('integer')->pluck('pretty_name')->unique();

        return view('discover.insights.clinicaltrials.show', compact(
            'companies',
            'focus_cats',
            'path',
            'sort',
            'status',
            'phases',
            'filters_focus',
            'filters_organizations',
            'filters_status',
            'filters_phases',
            'filters_researchers',
            'filters_conditions',
            'filters_interventions',
            'filters_outcome_measures',
            'filters_study_designs'
        ));
    }
    /**
     * @return \Illuminate\Database\Query\Builder
     */
    private function getQuery()
    {
        $conditionsSubquery = DB::table('ct_conditions')
                ->selectRaw("GROUP_CONCAT(ct_conditions.value SEPARATOR '; ')")
                ->join('clinicaltrial_condition', 'ct_conditions.id', 'clinicaltrial_condition.ct_condition_id')
                ->whereRaw('clinicaltrial_condition.clinicaltrial_id = clinicaltrials.id')
                ->groupBy('clinicaltrial_condition.clinicaltrial_id')
                ->toSql();

        return DB::table('companies')
            ->join('clinicaltrial_company', 'companies.id', 'clinicaltrial_company.company_id')
            ->join('clinicaltrials', 'clinicaltrials.id', 'clinicaltrial_company.clinicaltrial_id')
            ->join('clinicaltrial_focus', 'clinicaltrials.id', 'clinicaltrial_focus.clinicaltrial_id')
            ->join('focus', 'focus.id', 'clinicaltrial_focus.focus_id')
            ->select('companies.id as company_id', 'companies.name as company_name', 'companies.slug as company_slug',
                'clinicaltrials.id as clinicaltrial_id', 'clinicaltrials.title as title', 'clinicaltrials.slug as slug',
                'clinicaltrials.phases as phase_value', 'clinicaltrials.phase_integer as phase_integer', 'clinicaltrials.status as status',
                'focus.id as focus_id', 'focus.name as focus_name', 'focus.slug as focus_slug',
                DB::raw("($conditionsSubquery) as conditions")
            );
    }

    /**
     * @param \Illuminate\Database\Query\Builder $query
     * @param string $filter
     * @return \Illuminate\Database\Query\Builder
     */
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

    /**
     * @param \Illuminate\Database\Query\Builder $query
     * @param array $filter
     * @return \Illuminate\Database\Query\Builder
     */
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

        if(isset($filter['outcome_measures'])) {
            $query = $this->filterByOutcomeMeasures($query, $filter['outcome_measures']);
        }

        if(isset($filter['study_designs'])) {
            $query = $this->filterByStudyDesigns($query, $filter['study_designs']);
        }

        return $query;
    }

    /**
     * @param \Illuminate\Database\Query\Builder $query
     * @param array $params
     * @return \Illuminate\Database\Query\Builder
     */
    private function filterByFocus($query, $params)
    {
        return $query->whereIn('focus.name', $params);
    }

    /**
     * @param \Illuminate\Database\Query\Builder $query
     * @param array $params
     * @return \Illuminate\Database\Query\Builder
     */
    private function filterByOrganizations($query, $params)
    {
        return $query->whereIn('companies.name', $params);
    }

    /**
     * @param \Illuminate\Database\Query\Builder $query
     * @param array $params
     * @return \Illuminate\Database\Query\Builder
     */
    private function filterByStatus($query, $params)
    {
        return $query->whereIn('clinicaltrials.status', $params);
    }

    /**
     * @param \Illuminate\Database\Query\Builder $query
     * @param array $params
     * @return \Illuminate\Database\Query\Builder
     */
    private function filterByPhase($query, $params)
    {
        return $query->whereIn('clinicaltrials.phases', $params);
    }

    /**
     * @param \Illuminate\Database\Query\Builder $query
     * @param array $params
     * @return \Illuminate\Database\Query\Builder
     */
    private function filterByResearchers($query, $params)
    {
        return $query
            ->join('clinicaltrial_person', 'clinicaltrials.id', 'clinicaltrial_person.clinicaltrial_id')
            ->join('people', 'people.id', 'clinicaltrial_person.person_id')
            ->whereIn('people.name', $params);
    }

    /**
     * @param \Illuminate\Database\Query\Builder $query
     * @param array $params
     * @return \Illuminate\Database\Query\Builder
     */
    private function filterByConditions($query, $params)
    {
        return $query->join('clinicaltrial_condition', 'clinicaltrials.id', 'clinicaltrial_condition.clinicaltrial_id')
            ->join('ct_conditions', 'ct_conditions.id', 'clinicaltrial_condition.ct_condition_id')
            ->whereIn('ct_conditions.value', $params);
    }

    /**
     * @param \Illuminate\Database\Query\Builder $query
     * @param array $params
     * @return \Illuminate\Database\Query\Builder
     */
    private function filterByInterventions($query, $params)
    {
        return $query->join('clinicaltrial_intervention', 'clinicaltrials.id', 'clinicaltrial_intervention.clinicaltrial_id')
            ->join('ct_interventions', 'ct_interventions.id', 'clinicaltrial_intervention.ct_intervention_id')
            ->whereIn('ct_interventions.value', $params);
    }

    /**
     * @param \Illuminate\Database\Query\Builder $query
     * @param array $params
     * @return \Illuminate\Database\Query\Builder
     */
    private function filterByOutcomeMeasures($query, $params)
    {
        return $query->join('clinicaltrial_outcome_measure', 'clinicaltrials.id', 'clinicaltrial_outcome_measure.clinicaltrial_id')
            ->join('ct_outcome_measures', 'ct_outcome_measures.id', 'clinicaltrial_outcome_measure.ct_outcome_measure_id')
            ->whereIn('ct_outcome_measures.value', $params);
    }

    /**
     * @param \Illuminate\Database\Query\Builder $query
     * @param array $params
     * @return \Illuminate\Database\Query\Builder
     */
    private function filterByStudyDesigns($query, $params)
    {
        return $query->join('clinicaltrial_study_design', 'clinicaltrials.id', 'clinicaltrial_study_design.clinicaltrial_id')
            ->join('ct_study_designs', 'ct_study_designs.id', 'clinicaltrial_study_design.ct_study_design_id')
            ->whereIn('ct_study_designs.value', $params);
    }
}
