<?php

namespace App\Http\Controllers\Admin\Import;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        // Auth and Permission Middleware
        $this->middleware('auth');
        $this->middleware(['role:Admin','permission:import']);
    }

    // Show View for Viewing Import Results
    public function showResults($id) {

    	// Find Results
    	$results = ImportResult::find($id);

        // Get Messages
        $location_messages = json_decode($results->location_messages);
        $company_messages  = json_decode($results->company_messages);
        $people_messages   = json_decode($results->people_messages);

    	// Get CSV
    	$csv = json_decode($results->csv);

    	// Get API Results
    	$api_results = json_decode($results->api_results);

    	// Return View to Add People and Relationships
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
