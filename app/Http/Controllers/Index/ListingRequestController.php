<?php

namespace App\Http\Controllers\Index;

use App\Helpers\EntityHelper;
use App\Helpers\EntityMergeHelper;
use App\Models\Job;
use App\Models\ListingRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ListingRequestController extends Controller
{
    public function index()
    {
        return view('discover.listing-requests.index');
    }

    public function request()
    {
        $entityTypes = EntityHelper::getListingRequestEntities();

        return view('discover.listing-requests.request', [
            'entityTypes' => $entityTypes
        ]);
    }

    public function submitRequest(Request $request)
    {
        $allowedEntityTypes = EntityHelper::getListingRequestEntities();
        $entityType = $request->input('entity_type');

        if (isset($allowedEntityTypes[$entityType]) === false) {
            return redirect()->back()->with('error', 'Wrong entity type!');
        }

        $entityClass = $allowedEntityTypes[$entityType];
        $isUpdate = $request->input('is_update');
        $toUpdateId = $request->input('to_update_id');

        if ($isUpdate) {
            if (empty($toUpdateId)) {
                return redirect()->back()->with('error', 'You need to choose entity to update!');
            }

            $data['entity'] = $entityClass::findOrFail($toUpdateId);
        }

        $data['entityType'] = $entityType;
        $data['mapping'] = $entityClass::getListingRequestMapping();
        $data['relationValues'] = EntityMergeHelper::getMappingRelationValues($entityClass);

        return view('discover.listing-requests.entity', $data);
    }

    public function finishRequest(Request $request)
    {
        $entityType = $request->input('entity_type');
        $entityTypes = EntityHelper::getListingRequestEntities();

        if (isset($entityTypes[$entityType]) === false) {
            return redirect()->back()->with('error', 'Wrong entity type!');
        }

        $entityClass = $entityTypes[$entityType];
        $user = $request->user();
        $requestData = $request->all();
        $entityName = ($entityClass === Job::class) ? $requestData['job_title'] : $requestData['name'];
        $requestData = $this->handleFilesUpload($entityClass, $requestData);

        $listingRequest = new ListingRequest();
        $listingRequest->email = $user->email;
        $listingRequest->name = $user->name;
        $listingRequest->entity_type = $entityType;
        $listingRequest->entity_data = $requestData;
        $listingRequest->entity_name = $entityName;
        $listingRequest->to_update_id = $request->input('to_update_id');
        $listingRequest->comment = $request->input('comment');
        $listingRequest->save();

        $additionalEntitiesRequested = [];

        if (isset($data['entity_company_new'])) {
            $additionalEntitiesRequested['company'] = $data['entity_company_new'];
        }
        if (isset($data['entity_investor_new'])) {
            $additionalEntitiesRequested['investor'] = $data['entity_investor_new'];
        }

        return view('discover.listing-requests.finish', [
            'additionalEntitiesRequested' => $additionalEntitiesRequested
        ]);
    }

    public function getEntityListJson(Request $request)
    {
        $entityType = $request->input('type');
        $entityTypes = EntityHelper::getListingRequestEntities();

        if (isset($entityTypes[$entityType]) === false) {
            return response()->json(['status' => 'error'], 404);
        }

        $entityClass = $entityTypes[$entityType];

        $data = $entityClass::all()->map(function ($item, $key) {
            return [
                'id'   => $item->id,
                'name' => $item->name
            ];
        });

        return response()->json([
            'status' => 'ok',
            'data'   => $data
        ]);
    }

    /**
     * @param string $entityClass
     * @param array $requestData
     * @return array
     */
    private function handleFilesUpload($entityClass, $requestData)
    {
        $fieldMapping = $entityClass::getMergeMapping();

        foreach ($fieldMapping as $field => $options) {
            if ($options['type'] === EntityMergeHelper::TYPE_IMAGE && isset($requestData[$field])) {
                $file = $requestData[$field];
                $filename = Carbon::now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();
                $requestData[$field] = Storage::disk('public')->putFileAs('requests', $file, $filename);
            }
        }

        return $requestData;
    }
}
