<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\JobRequest;
use App\Models\Job;

class JobsController extends ApiBaseController
{
    protected $hiddenFields = [
        'slug',
        'created_at',
        'updated_at',
        'owner_id',
        'owner_type',
        'owner',
    ];

    protected $allowedFields = [
        'owner_id',
        'owner_type',
        'job_title',
        'job_description',
        'employment_type',
        'posted_date',
        'status',
        'salary',
        'hourly_rate',
    ];

    protected $showEntityRouteName = 'discover.jobs.show';

    public function index()
    {
        $relationsWithArray = [
            'owner',
            'focus' => function ($query) {
                return $query->select('name');
            },
            'locations' => function ($query) {
                return $query->select('name');
            },
        ];

        $data = Job::open()
            ->with($relationsWithArray)
            ->orderBy('posted_date', 'desc')
            ->get()
            ->map(function ($entity) {
                $entity->organization_name = $entity->ownerName;
                $entity->organization_url = $entity->ownerShowUrl;
                $this->prepareEntityForResponse($entity);

                foreach ($entity->getRelations() as $relationName => $relationItems) {
                    if (in_array($relationName, ['focus', 'locations'])) {
                        $relationItems->map(function ($relationItem) use ($relationName) {
                            $relationItem->makeHidden('pivot');
                        });
                    }
                }

                return $entity;
            });

        return response()->json($data);
    }

    public function create(JobRequest $request)
    {
        $data = $this->filterRequestData($request->all());

        $data['owner_type'] = Job::OWNER_TYPES[$data['owner_type']];
        $ownerModel = $data['owner_type'];
        $owner = $ownerModel::find($data['owner_id']);

        if ($owner === null) {
            return response()->json(['message' => 'Owner not found.'], 400);
        }

        try {
            $entity = Job::create($data);
        } catch (\Throwable $throwable) {
            return response()->json(['status' => 'Error', 'message' => $throwable->getMessage()]);
        }

        $entity->organization_name = $entity->ownerName;
        $entity->organization_url = $entity->ownerShowUrl;
        $this->prepareEntityForResponse($entity);

        return response()->json([
            'status' => 'Success',
            'message' => 'Job created.',
            'data' => $entity,
        ]);
    }

    public function update(JobRequest $request, $id)
    {
        $entity = Job::find($id);

        if ($entity === null) {
            return response()->json(['message' => 'Record not found.'], 404);
        }

        $data = $this->filterRequestData($request->all());

        if ($data['owner_type'] && $data['owner_id']) {
            $data['owner_type'] = Job::OWNER_TYPES[$data['owner_type']];
            $ownerModel = $data['owner_type'];
            $owner = $ownerModel::find($data['owner_id']);

            if ($owner === null) {
                return response()->json(['message' => 'Owner not found.'], 400);
            }
        }

        try {
            $entity->update($data);
        } catch (\Throwable $throwable) {
            return response()->json(['status' => 'Error', 'message' => $throwable->getMessage()]);
        }

        $entity->organization_name = $entity->ownerName;
        $entity->organization_url = $entity->ownerShowUrl;
        $this->prepareEntityForResponse($entity);

        return response()->json([
            'status' => 'Success',
            'message' => 'Job updated.',
            'data' => $entity,
        ]);
    }
}
