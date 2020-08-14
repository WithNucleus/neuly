<?php

namespace App\Http\Controllers\Admin\Import;

use App\Helpers\StringHelper;
use App\Http\Controllers\Controller;
use App\Jobs\Import\ClinicalTrial\ProcessLocation;
use App\Jobs\Import\ClinicalTrial\ProcessSponsorCollaborators;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Clinicaltrial;
use App\Models\Location;
use Illuminate\Support\Facades\Log;
use Auth;
use App\Models\ImportResult;

class ClinicalTrialController extends Controller
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

    // Show View for Importing Clinial Trials
    public function importClinicaltrials() {

    	// Get Previous Imports
    	$import_results = ImportResult::where('entity', 'Clinical Trials')
    		->orderBy('created_at', 'desc')
    		->take(20)
    		->get();

    	// Return View to Add People and Relationships
    	return view('admin.import.clinicaltrials', compact('import_results'));
    }

    // Process Imported Clincal Trials
    public function processClinicaltrials(Request $request) {

    	$validated = $request->validate([
        	'focus_id' => 'required|integer',
        	'csv' => 'required|mimes:csv,txt',
    	]);

    	// Focus
    	$focus_id = $request->input('focus_id');

    	// Parse CSV File
    	$records = array_map('str_getcsv', file($request->file('csv')));

    	// Save to Import Results
    	$import_attributes = array(
    		'entity' => 'Clinical Trials',
    		'csv' => json_encode($records),
    		'user_id' => Auth::id(),
    		'focus_id' => $focus_id
    	);

    	$import_result = ImportResult::create($import_attributes);

    	// Grab Headings then Remove
    	$headings = $records[0];
    	array_shift($records);

    	// Slugify Headings
    	foreach ($headings as $key => $value) {

    		$new_value = Str::slug($value, '_');

    		if ($new_value == 'url') {
    			$new_value = 'study_url';
    		}

    		$headings[$key] = $new_value;
    	}

    	// $record_status = array();

    	// Loop through Records
    	foreach ($records as $record) {

    		$attributes = array();

    		$nct_number = '';

            $newLocationNames     = [];
            $sponsorCollaborators = [];

    		// Loop through columns in a record
    		foreach ($record as $key => $value) {

	    		$column = $headings[$key];

	    		// if column name
	    		if ($column == 'nct_number') {

	    			$nct_number = $value;
	    			$attributes['nct_number'] = $nct_number;

	    		} elseif ($column == 'start_date' OR
	    			$column == 'primary_completion_date' OR
	    			$column == 'completion_date' OR
	    			$column == 'first_posted' OR
	    			$column == 'results_first_posted' OR
	    			$column == 'last_update_posted')
	    		{
	    			// if a date field convert format
	    			$date = Carbon::parse($value)->format('Y-m-d');

	    			// Push this to $attributes
	    			$attributes[$column] = $date;

                } elseif ($column == 'locations') {

                    $locations = StringHelper::explodeAndFilterEmpty($value, '|');

                    foreach ($locations as $location) {

                        $newLocation   = [];
                        $locationParts = StringHelper::explodeAndFilterEmpty($location, ',');
                        $locationParts = array_reverse($locationParts);

                        if ($locationParts[0] == 'United States') {
                            $country = 'USA';
                            $region  = $locationParts[1];
                            $city    = $locationParts[2];

                            $newLocation = [
                                'country' => $country,
                                'region'  => $region,
                                'city'    => $city,
                            ];
                        } elseif ($locationParts[0] == 'Canada') {
                            if (array_key_exists(2, $locationParts)) {
                                $country = 'Canada';
                                $region  = $locationParts[1];
                                $city    = $locationParts[2];

                                $newLocation = [
                                    'country' => $country,
                                    'region'  => $region,
                                    'city'    => $city,
                                ];
                            } else {
                                $country = 'Canada';
                                $region  = $locationParts[1];

                                $newLocation = [
                                    'country' => $country,
                                    'region'  => $region,
                                ];
                            }
                        } elseif ($locationParts[0] != '') {
                            // Not sure on the format so take what is hopefully the country and region
                            $country = $locationParts[0];
                            $region  = $locationParts[1];

                            $newLocation = [
                                'country' => $country,
                                'region'  => $region,
                            ];
                        }

                        if ($newLocation !== []) {
                            array_push($newLocationNames, $newLocation);
                        }
                    }

                } elseif ($column == 'sponsorcollaborators') {

                    $sponsorCollaborators = StringHelper::explodeAndFilterEmpty($value, '|');

	    		} elseif ($column == 'rank' OR $column == 'study_documents') {

	    			// ignore these

	    		} else {

	    			$attributes[$column] = $value;
	    		}

	    	}

	    	$clinicaltrial = Clinicaltrial::updateOrCreate(
	    		['nct_number' => $nct_number],
	    		$attributes
	    	);

			if ($newLocationNames !== []) {
                ProcessLocation::dispatch($clinicaltrial, $import_result, $newLocationNames);
			}

			if ($sponsorCollaborators !== []) {
                ProcessSponsorCollaborators::dispatch($clinicaltrial, $import_result, $sponsorCollaborators);
            }

	    	$clinicaltrial->focus()->syncWithoutDetaching($focus_id);
    	}

    	return redirect(route('import.clinicaltrials'));
    }
}
