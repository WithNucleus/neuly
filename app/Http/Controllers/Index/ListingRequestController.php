<?php

namespace App\Http\Controllers\Index;

use App\Helpers\Entity\FieldsMapping;
use App\Helpers\ListingRequestHelper;
use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\ListingRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ListingRequestController extends Controller
{
    public function index()
    {
        return view('discover.listing-requests.index');
    }

    public function request()
    {
        $entityTypes = ListingRequestHelper::getAllowedEntities();

        return view('discover.listing-requests.request', [
            'entityTypes' => $entityTypes,
        ]);
    }

    public function submitRequest(Request $request)
    {
        $entityType = $request->input('entity_type');
        $isUpdate = $request->input('is_update');
        $toUpdateId = $request->input('to_update_id');

        try {
            $entityClass = ListingRequestHelper::getEntityClassByType($entityType);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Wrong entity type!');
        }

        if ($isUpdate) {
            if (empty($toUpdateId)) {
                return redirect()->back()->with('error', 'You need to choose entity to update!');
            }

            $data['entity'] = $entityClass::findOrFail($toUpdateId);
        }

        $data['entityType'] = $entityType;
        $data['mapping'] = $entityClass::getListingRequestMapping();
        $data['relationValues'] = ListingRequestHelper::getEntityRelationValuesByType($entityType);

        return view('discover.listing-requests.entity', $data);
    }

    public function finishRequest(Request $request)
    {
        $entityType = $request->input('entity_type');
        $entityTypes = ListingRequestHelper::getAllowedEntities();

        if (isset($entityTypes[$entityType]) === false) {
            return redirect()->back()->with('error', 'Wrong entity type!');
        }

        $entityClass = $entityTypes[$entityType];
        $requestData = $request->except('_token', 'comment', 'entity_type', 'to_update_id', 'applicant_name', 'applicant_email');
        $entityName = ($entityClass === Job::class) ? $requestData['job_title'] : $requestData['name'];
        $requestData = $this->handleFilesUpload($entityClass, $requestData);

        $listingRequest = new ListingRequest();

        if (auth()->check()) {
            $user = auth()->user();
            $listingRequest->user_id = $user->id;
            $listingRequest->email = $user->email;
            $listingRequest->name = $user->name;
        } else {
            $listingRequest->email = $request->input('applicant_email');
            $listingRequest->name = $request->input('applicant_name');
        }

        $listingRequest->entity_type = $entityType;
        $listingRequest->entity_data = $requestData;
        $listingRequest->entity_name = $entityName;
        $listingRequest->to_update_id = $request->input('to_update_id');
        $listingRequest->comment = $request->input('comment');
        $listingRequest->save();

        $additionalEntitiesRequested = [];

        return view('discover.listing-requests.finish', [
            'additionalEntitiesRequested' => $additionalEntitiesRequested,
        ]);
    }

    public function getEntityListJson(Request $request)
    {
        $entityType = $request->input('type');
        $entityClass = ListingRequestHelper::getEntityClassByType($entityType);

        $data = $entityClass::all()->map(function ($item, $key) {
            return [
                'id' => $item->id,
                'name' => $item->name,
            ];
        });

        return response()->json([
            'status' => 'ok',
            'data' => $data,
        ]);
    }

    /**
     * @param string $entityClass
     * @param array $requestData
     * @return array
     */
    private function handleFilesUpload($entityClass, $requestData)
    {
        $fieldMapping = $entityClass::getFieldsMapping();

        foreach ($fieldMapping as $field => $options) {
            if ($options['type'] === FieldsMapping::TYPE_IMAGE && isset($requestData[$field])) {
                $file = $requestData[$field];
                $filename = Carbon::now()->format('YmdHis').'.'.$file->getClientOriginalExtension();
                $requestData[$field] = Storage::disk('public')->putFileAs('requests', $file, $filename);
            }
        }

        return $requestData;
    }
}
