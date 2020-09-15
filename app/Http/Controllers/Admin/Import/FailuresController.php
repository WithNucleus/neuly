<?php

namespace App\Http\Controllers\Admin\Import;

use App\Helpers\Import\CriticalTrial\ImportFailureCorrector as ClinicalTrialCorrector;
use App\Helpers\Import\RelatedEntities\ImportFailureCorrector as RelatedEntitiesCorrector;
use App\Helpers\StringHelper;
use App\Http\Controllers\Controller;
use App\Models\ImportFailure;
use App\Models\ImportResult;
use Illuminate\Http\Request;

class FailuresController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:Admin','permission:import']);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showByType($importResultId, $type)
    {
        $allowedTypes = [
            ImportFailure::TYPE_LOCATIONS,
            ImportFailure::TYPE_SPONSOR_COLLABORATORS
        ];

        if (!in_array($type, $allowedTypes)) {
            abort(404);
        }

        $failures = ImportFailure::where('import_result_id', $importResultId)
            ->where('type', $type)
            ->get();

        if ($type === ImportFailure::TYPE_LOCATIONS) {
            foreach ($failures as $failure) {
                if (!empty($failure->details['import_value'])) {
                    $locationParts = StringHelper::explodeAndFilterEmpty($failure->details['import_value'], ',');
                    $locationParts = array_reverse($locationParts);

                    $failure->location_parts = [
                        'country' => $locationParts[0],
                        'region'  => isset($locationParts[1]) ? $locationParts[1] : '',
                        'city'    => isset($locationParts[2]) ? $locationParts[2] : '',
                    ];
                }
            }
        }

        return view('admin.import.failures.' . $type, compact('importResultId', 'failures'));
    }

    /**
     * Ajax method for manual fix of ImportFailure
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function fix(Request $request, $id)
    {
        $failure = ImportFailure::with('result')->findOrFail($id);

        switch ($failure->result->type) {
            case ImportResult::TYPE_CLINICAL_TRIALS:
                $result = ClinicalTrialCorrector::correctFailure($failure, $request->all());
                break;
            case ImportResult::TYPE_RELATED_ENTITIES:
                $result = RelatedEntitiesCorrector::correctFailure($failure, $request->all());
                break;
        }

        return response()->json([
            'status' => ($result === true) ? 'success' : 'failed',
        ]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request, $id)
    {
        ImportFailure::destroy($id);

        return response()->json([
            'status' => 'success',
        ]);
    }
}
