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
        $this->middleware('auth');
        $this->middleware(['role:Admin','permission:import']);
    }

    public function importClinicaltrials()
    {
    	$import_results = ImportResult::clinicalTrials()
    		->latest()
    		->take(20)
    		->get();

    	return view('admin.import.clinicaltrials', compact('import_results'));
    }

    public function processClinicaltrials(Request $request)
    {
    	$validated = $request->validate([
        	'focus_id' => 'required|integer',
        	'csv' => 'required|mimes:csv,txt',
    	]);

        $focusId            = $request->input('focus_id');
        $clinicaltrialCache = [];
        $dateColumns        = [
            'start_date',
            'primary_completion_date',
            'completion_date',
            'first_posted',
            'results_first_posted',
            'last_update_posted',
        ];

        $records          = array_map('str_getcsv', file($request->file('csv')));
        $importAttributes = [
            'type'     => ImportResult::TYPE_CLINICAL_TRIALS,
            'entity'   => 'Clinical Trials',
            'csv'      => json_encode($records),
            'user_id'  => Auth::id(),
            'focus_id' => $focusId
        ];
        $importResult     = ImportResult::create($importAttributes);

        $headings = array_shift($records);

    	foreach ($headings as $key => $value) {
    		$new_value = Str::slug($value, '_');

    		if ($new_value == 'url') {
    			$new_value = 'study_url';
    		}

    		$headings[$key] = $new_value;
    	}

    	foreach ($records as $record) {

            $nctNumber            = '';
            $locations            = [];
            $sponsorCollaborators = [];
            $attributes           = [];

    		// Loop through columns in a record
    		foreach ($record as $key => $value) {
	    		$column = $headings[$key];

	    		// if column name
	    		if ($column == 'nct_number') {
                    $nctNumber = $value;
	    			$attributes['nct_number'] = $nctNumber;

	    		} elseif (in_array($column, $dateColumns)) {
	    			$attributes[$column] = Carbon::parse($value)->format('Y-m-d');

                } elseif ($column == 'locations') {
                    $locations = StringHelper::explodeAndFilterEmpty($value, '|');

                } elseif ($column == 'sponsorcollaborators') {
                    $sponsorCollaborators = StringHelper::explodeAndFilterEmpty($value, '|');

	    		} elseif ($column == 'rank' OR $column == 'study_documents') {
	    			// ignore these

	    		} else {
	    			$attributes[$column] = $value;
	    		}
	    	}

    		if (!isset($clinicaltrialCache[$nctNumber])) {
                $clinicaltrialCache[$nctNumber] = Clinicaltrial::updateOrCreate(
                    ['nct_number' => $nctNumber],
                    $attributes
                );
            }

            $clinicaltrial = $clinicaltrialCache[$nctNumber];

			if ($locations !== []) {
                ProcessLocation::dispatch($clinicaltrial, $importResult, $locations);
			}

			if ($sponsorCollaborators !== []) {
                ProcessSponsorCollaborators::dispatch($clinicaltrial, $importResult, $sponsorCollaborators);
            }

	    	$clinicaltrial->focus()->syncWithoutDetaching($focusId);
    	}

    	return redirect(route('import.clinicaltrials'));
    }
}
