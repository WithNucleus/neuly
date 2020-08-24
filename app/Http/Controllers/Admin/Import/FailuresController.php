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
        $failure = ImportFailure::findOrFail($id);
        $result  = ImportFailureCorrector::correctFailure($failure, $request->all());

        return response()->json([
            'status' => ($result === true) ? 'success' : 'failed',
        ]);
    }
}
