<?php

namespace App\Http\Controllers\Admin\Import;

use App\Http\Controllers\Controller;
use App\Models\ImportResult;

class ResultsController extends Controller
{

	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:Admin','permission:import']);
    }

    public function showResults($id) {
    	$results = ImportResult::find($id);

        $location_messages = json_decode($results->location_messages);
        $company_messages  = json_decode($results->company_messages);
        $people_messages   = json_decode($results->people_messages);

    	$csv = json_decode($results->csv);
    	$api_results = json_decode($results->api_results);

    	return view('admin.import.results', compact(
    		'results',
    		'location_messages',
    		'company_messages',
    		'people_messages',
    		'csv',
    		'api_results'
    	));
    }

    public function showFailures($id)
    {
        $result              = ImportResult::with('failures')->findorFail($id);
        $failuresTotalByType = [];

        foreach ($result->failures as $failure) {
            if (isset($failuresTotalByType[$failure->type])) {
                $failuresTotalByType[$failure->type]++;
            } else {
                $failuresTotalByType[$failure->type] = 1;
            }
        }

        return view('admin.import.failures', compact('result', 'failuresTotalByType'));
    }
}
