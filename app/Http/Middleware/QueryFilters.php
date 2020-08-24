<?php

namespace App\Http\Middleware;

use Closure;

class QueryFilters
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        // Get Path
        $path = $request->getPathInfo();

        // Collect Filters
        $filters = collect($request->query('filter'));

        $sort = collect($request->query('sort'))->toArray();
        $sort_string = implode('', $sort);

        // If focus
        if (isset($request->query('filter')['focus'])) {
            $focus_array = $request->query('filter')['focus'];
            $focus_array = explode('|', $focus_array);
        } else {
            $focus_array = array();
        }

        // If locations
        if (isset($request->query('filter')['locations'])) {
            $location_string = $request->query('filter')['locations'];
            $location_array = explode('|', $location_string);
        } else {
            $location_array = array();
        }

        // If region
        if (isset($request->query('filter')['region'])) {
            $regions_array = explode('|', $request->query('filter')['region']);
        } else {
            $regions_array = array();
        }

        // If countries
        if (isset($request->query('filter')['countries'])) {
            $countries_array = explode('|', $request->query('filter')['countries']);
        } else {
            $countries_array = array();
        }

        // If company
        if (isset($request->query('filter')['company'])) {
            $company_name_array = explode('|', $request->query('filter')['company']);
        } else {
            $company_name_array = array();
        }

        // If status
        if (isset($request->query('filter')['status'])) {
            $status_array = explode('|', $request->query('filter')['status']);
        } else {
            $status_array = array();
        }

        // If type
        if (isset($request->query('filter')['type'])) {
            $type_array = explode('|', $request->query('filter')['type']);
        } else {
            $type_array = array();
        }

        // If people
        if (isset($request->query('filter')['people'])) {
            $person_name_array = explode('|', $request->query('filter')['people']);
        } else {
            $person_name_array = array();
        }

        if (isset($request->query('filter')['hiring'])) {
            $filter_hiring = $request->query('filter')['hiring'];
        } else {
            $filter_hiring = 0;
        }

        // Share with Blade
        view()->share('filters', $filters);
        view()->share('sort', $sort_string);
        view()->share('filters_focus', $focus_array);
        view()->share('filters_location', $location_array);
        view()->share('filters_regions', $regions_array);
        view()->share('filters_countries', $countries_array);
        view()->share('filters_company_name', $company_name_array);
        view()->share('filters_person_name', $person_name_array);
        view()->share('filters_status', $status_array);
        view()->share('filters_type', $type_array);
        view()->share('filter_hiring', $filter_hiring);
        view()->share('path', $path);

        // Return Next Request
        return $next($request);
    }
}
