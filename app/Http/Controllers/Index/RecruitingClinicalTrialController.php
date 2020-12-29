<?php

namespace App\Http\Controllers\Index;

use App\Models\Clinicaltrial;
use App\Models\Focus;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class RecruitingClinicalTrialController extends Controller
{
    private const RECRUITING_STATUS = 'Recruiting';

    public function index(Request $request)
    {
        $filter = $request->input('filter');
        $sort = $this->getSortValue($request);

        $query = $this->getQuery();

        $filters_focus = [];
        $filters_location = [];
        $filters_gender = [];
        $filters_age = 50;

        if($request->has('filter'))
        {
            $filterInput = $request->input('filter');
            $filter = array_map(function ($entity) {
                return explode('|', $entity);
            }, $filterInput);

            $query = $this->filterQuery($query, $filter);

            $filters_focus = $this->getFilterValues($filter, 'focus');
            $filters_location = $this->getFilterValues($filter, 'locations');
            $filters_gender = $this->getFilterValues($filter, 'gender');
            $filters_age = $this->getFirstValueFromArray($this->getFilterValues($filter, 'age'));

            if($filters_age === [])
            {
                $filters_age = 50;
            }
        }

        $query = $this->sortQuery($query, $sort);

        $clinicaltrials = $query->paginate(10);

        $focus_cats = Focus::drugs()->orderBy('name')->get()->pluck('name');
        $locations = Location::select('country')
            ->join('clinicaltrial_location', 'locations.id', 'clinicaltrial_location.location_id')
            ->orderBy('country')
            ->pluck('country')
            ->unique();
        $gender = Clinicaltrial::select('gender')
            ->whereNotNull('gender')
            ->orderBy('gender')
            ->pluck('gender')
            ->unique();
        $age_min = 0;
        $age_max = 100;


        $path = route('discover.clinicaltrials.recruiting');

        return view('discover.recruitingtrials.index', compact(
            'clinicaltrials',
            'focus_cats',
            'locations',
            'gender',
            'age_min',
            'age_max',
            'filters_focus',
            'filters_location',
            'filters_gender',
            'filters_age',
            'path',
            'sort'
        ));
    }

    private function getQuery()
    {
        return Clinicaltrial::select('clinicaltrials.id','title', 'gender', 'age', 'study_type', 'clinicaltrials.slug', 'start_date', 'last_update_posted')
            ->where('status', '=', self::RECRUITING_STATUS);
    }

    private function filterQuery($query, $request)
    {

        if(array_key_exists('gender', $request))
        {
            $query = $this->filterByGender($query, $request['gender'][0]);
        }
        if(array_key_exists('age', $request))
        {
            $query = $this->filterByAge($query, $request['age']);
        }
        if(array_key_exists('locations', $request))
        {
            $query = $this->filterByLocation($query, $request['locations']);
        }
        if(array_key_exists('focus', $request))
        {
            $query = $this->filterByFocus($query, $request['focus']);
        }

        return $query;
    }

    private function filterByGender($query, $gender)
    {
        return $query->where('gender', '=', ucfirst($gender));
    }

    private function filterByAge($query, $age)
    {
        return $query->where(function($ageQuery) use ($age) {
            $ageQuery->where(function($tmpQuery) use ($age) {
                $tmpQuery->where('min_age', '>=', $age);
                $tmpQuery->where('max_age', '<=', $age);
            })
            ->orWhere(function($tmpQuery) use ($age) {
                $tmpQuery->whereNull('min_age');
                $tmpQuery->where('max_age', '>=', $age);
            })
            ->orWhere(function($tmpQuery) use ($age) {
                $tmpQuery->whereNull('max_age');
                $tmpQuery->where('min_age', '<=', $age);
            })
            ->orWhere(function($tmpQuery) {
                $tmpQuery->whereNull('min_age');
                $tmpQuery->whereNull('max_age');
            });
        });
    }

    private function filterByLocation($query, $location)
    {
        return $query->leftJoin('clinicaltrial_location', 'clinicaltrials.id', '=', 'clinicaltrial_location.clinicaltrial_id')
            ->leftJoin('locations', 'clinicaltrial_location.location_id', '=', 'locations.id')
            ->whereIn('locations.country', $location);
    }

    private function filterByFocus($query, $focus)
    {
        return $query->leftJoin('clinicaltrial_focus', 'clinicaltrials.id', '=', 'clinicaltrial_focus.clinicaltrial_id')
            ->leftJoin('focus', 'clinicaltrial_focus.focus_id', '=', 'focus.id')
            ->whereIn('focus.name', $focus);
    }

    private function getFilterValues($filter, $type)
    {
        return array_key_exists($type, $filter) ? $filter[$type] : [];

    }

    private function getFirstValueFromArray($array)
    {
        return (is_array($array) && count($array) >= 1) ? $array[0] : $array;
    }

    private function getSortValue($request)
    {
        return $request->has('sort') ? $request->input('sort') : 'title';
    }

    private function sortQuery($query, $sort)
    {
        return ($sort === 'title') ? $query->orderBy('title', 'asc') : $query->orderBy('title', 'desc');
    }
}
