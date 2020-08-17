<?php

namespace App\Http\Controllers\Admin\Import;

use App\Helpers\Import\CriticalTrial\ImportFailureCorrector;
use App\Http\Controllers\Controller;
use App\Models\ImportFailure;
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
    public function sponsorCollaboratorsIndex($importResultId)
    {
        $type     = ImportFailure::TYPE_SPONSOR_COLLABORATORS;
        $failures = ImportFailure::where('import_result_id', $importResultId)
            ->where('type', $type)
            ->get();

        return view('admin.import.failures.sponsorcollaborators', compact('importResultId', 'failures'));
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
        $failure   = ImportFailure::findOrFail($id);
        $modelName = $request->get('model');

        $result = ImportFailureCorrector::correctFailure($failure, $modelName);

        return response()->json([
            'status' => ($result === true) ? 'success' : 'failed',
        ]);
    }
}
