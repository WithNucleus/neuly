<?php

namespace App\Http\Controllers\Admin\Import;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Clinicaltrial;
use App\Models\Location;
use App\Jobs\ProcessClinicalTrialLocation;
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

    		$location_id_array = array();
    		$location_name_array = array();

    		// Loop through columns in a record
    		foreach ($record as $key => $value) {

	    		$column = $headings[$key];

	    		$this_value = $value;

	    		// if column name
	    		if ($column == 'nct_number') {

	    			$nct_number = $this_value;
	    			$attributes['nct_number'] = $nct_number;

	    		} elseif ($column == 'start_date' OR 
	    			$column == 'primary_completion_date' OR 
	    			$column == 'completion_date' OR 
	    			$column == 'first_posted' OR
	    			$column == 'results_first_posted' OR 
	    			$column == 'last_update_posted')
	    		{
	    			// if a date field convert format
	    			$date = Carbon::parse($this_value)->format('Y-m-d');

	    			// Push this to $attributes
	    			$attributes[$column] = $date;

	    		} elseif ($column == 'locations') {

					// process locations

					$locations_list = $value;
					$locations_array = explode('|', $locations_list);

					// loop through array
					foreach ($locations_array as $string) {

						if ($string == '') {

							// blank location so ignore this

						} else {

							$this_location = explode(',', $string);

							// Reverse so Country is first
							$this_location = array_reverse($this_location);

							// Remove whitespace
							$this_location = array_map('trim', $this_location);

							if ($this_location[0] == 'United States') {
								
								// location[1] & location[2] will be state & city
								$city = $this_location[2];
								$region = $this_location[1];
								$country = 'USA';

								$location_array = [
									'city' => $city,
									'region' => $region,
									'country' => $country
								];

								// array_push($location_name_array, $city . ', ' . $region . ', ' . $country);
								array_push($location_name_array, $location_array);

							} elseif ($this_location[0] == 'Canada') {

								// has city?
								if (array_key_exists(2, $this_location)) {
									$city = $this_location[2];
									$region = $this_location[1];
									$country = 'Canada';

									$location_array = [
										'city' => $city,
										'region' => $region,
										'country' => $country
									];
								} else {
									$region = $this_location[1];
									$country = 'Canada';

									$location_array = [
										'region' => $region,
										'country' => $country
									];
								}

								// array_push($location_name_array, $city . ', ' . $region . ', ' . $country);
								array_push($location_name_array, $location_array);

							} else {

								if ( $this_location[0] != '' ) {
									// Not sure on the format so take what is hopefully the country and region
									$country = $this_location[0];
									$region = $this_location[1];

									$location_array = [
										'region' => $region,
										'country' => $country
									];

									array_push($location_name_array, $location_array);
								}

								
							}
						}
					}


	    		} elseif ($column == 'sponsorcollaborators') {

	    			// if sponsorcollaborators

	    		} elseif ($column == 'rank' OR $column == 'study_documents') {

	    			// ignore these

	    		} else {

	    			// Push this to $attributes
	    			$attributes[$column] = $this_value;
	    		}
	    		
	    	}

	    	// Create or Update
	    	$clinicaltrial = Clinicaltrial::updateOrCreate(
	    		['nct_number' => $nct_number],
	    		$attributes
	    	);

	    	// Send Location Matching to Queue
			if (!empty($location_name_array)) {
				ProcessClinicalTrialLocation::dispatch($clinicaltrial, $import_result, $location_name_array);
			}

	    	// Assign Focus Relationship
	    	$clinicaltrial->focus()->syncWithoutDetaching($focus_id);

	    	// Assign Location Relationship with $location_id_array
	    	$clinicaltrial->locations()->syncWithoutDetaching($location_id_array);

    	}

    	// Return to Import Results
    	return redirect(route('import.clinicaltrials'));

    }
}
