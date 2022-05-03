<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CompanyRequest;
use App\Models\Company;

class CompaniesController extends ApiBaseController
{
    protected $hiddenFields = [
        'slug',
        'logo',
        'visibility',
        'visibility_code',
        'created_at',
        'updated_at',
        'focus_description',
        'location',
        'contact_info',
        'notes',
    ];

    protected $allowedFields = [
        'name',
        'ownership',
        'website',
        'ticker_symbol',
        'summary',
        'founded_date',
        'valuation',
        'total_funding_amount',
        'last_funding_date',
        'number_employees',
        'facebook',
        'instagram',
        'linkedin',
    ];

    protected $showEntityRouteName = 'discover.people.show';

    public function index()
    {
        $relationsWithArray = [
            'focus' => function ($query) {
                return $query->select('name');
            },
            'locations' => function ($query) {
                return $query->select('name');
            },
            'investors' => function ($query) {
                return $query->select('name', 'slug');
            },
            'people' => function ($query) {
                return $query->select('name', 'slug');
            },
            'research' => function ($query) {
                return $query->select('name', 'slug');
            },
            'jobs' => function ($query) {
                return $query->open()->select('owner_id', 'job_title', 'slug');
            },
            'events' => function ($query) {
                return $query->upcoming()->select('name', 'slug');
            },
            'clinicaltrials' => function ($query) {
                return $query->select('title', 'slug');
            },
            'parents' => function ($query) {
                return $query->select('name');
            },
            'subsidiaries' => function ($query) {
                return $query->select('name');
            },
        ];
        $entityShowRoutesMapping = [
            'investors' => 'discover.investors.show',
            'people' => 'discover.people.show',
            'research' => 'discover.research.show',
            'events' => 'discover.events.show',
            'jobs' => 'discover.jobs.show',
            'clinicaltrials' => 'discover.clinicaltrials.show',
        ];

        $data = Company::public()
            ->with($relationsWithArray)
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

    public function create(CompanyRequest $request)
    {
        $data = $this->filterRequestData($request->all());

        try {
            $entity = Company::create($data);
        } catch (\Throwable $throwable) {
            return response()->json(['status' => 'Error', 'message' => $throwable->getMessage()]);
        }

        $this->prepareEntityForResponse($entity);

        return response()->json([
            'status' => 'Success',
            'message' => 'Organization created.',
            'data' => $entity,
        ]);
    }

    public function update(CompanyRequest $request, $id)
    {
        $entity = Company::find($id);

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
            'message' => 'Organization updated.',
            'data' => $entity,
        ]);
    }
}
