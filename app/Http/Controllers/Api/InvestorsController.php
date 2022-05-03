<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\InvestorRequest;
use App\Models\Investor;

class InvestorsController extends ApiBaseController
{
    protected $hiddenFields = [
        'slug',
        'logo',
        'created_at',
        'updated_at',
    ];

    protected $allowedFields = [
        'name',
        'website',
        'type',
    ];

    protected $showEntityRouteName = 'discover.investors.show';

    public function index()
    {
        $relationsWithArray = [
            'locations' => function ($query) {
                return $query->select('name');
            },
            'companies' => function ($query) {
                return $query->select('name', 'slug');
            },
            'people' => function ($query) {
                return $query->select('name', 'slug');
            },
            'jobs' => function ($query) {
                return $query->open()->select('owner_id', 'job_title', 'slug');
            },
        ];
        $entityShowRoutesMapping = [
            'companies' => 'discover.organizations.show',
            'people' => 'discover.people.show',
            'jobs' => 'discover.jobs.show',
        ];

        $data = Investor::with($relationsWithArray)
            ->get()
            ->map(function ($entity) use ($entityShowRoutesMapping) {
                $this->prepareEntityForResponse($entity);

                foreach ($entity->getRelations() as $relationName => $relationItems) {
                    $relationItems->map(function ($relationItem) use ($relationName, $entityShowRoutesMapping) {
                        if (isset($entityShowRoutesMapping[$relationName]) && isset($relationItem->slug)) {
                            $relationItem->url = route($entityShowRoutesMapping[$relationName], $relationItem->slug);
                            $relationItem->makeHidden('slug');
                        }

                        //Eloquent issue with morphed relation: without selecting "owner_id" no records will be retrieved
                        if ($relationName == 'jobs') {
                            $relationItem->makeHidden('owner_id');
                        }

                        $relationItem->makeHidden('pivot');
                    });
                }

                return $entity;
            });

        return response()->json($data);
    }

    public function create(InvestorRequest $request)
    {
        $data = $this->filterRequestData($request->all());

        try {
            $entity = Investor::create($data);
        } catch (\Throwable $throwable) {
            return response()->json(['status' => 'Error', 'message' => $throwable->getMessage()]);
        }

        $this->prepareEntityForResponse($entity);

        return response()->json([
            'status' => 'Success',
            'message' => 'Investor created.',
            'data' => $entity,
        ]);
    }

    public function update(InvestorRequest $request, $id)
    {
        $entity = Investor::find($id);

        if ($entity === null) {
            return response()->json(['message' => 'Record not found.'], 404);
        }

        $data = $this->filterRequestData($request->all());

        try {
            $entity->update($data);
        } catch (\Throwable $throwable) {
            return response()->json(['status' => 'Error', 'message' => $throwable->getMessage()]);
        }

        $this->prepareEntityForResponse($entity);

        return response()->json([
            'status' => 'Success',
            'message' => 'Investor updated.',
            'data' => $entity,
        ]);
    }
}
