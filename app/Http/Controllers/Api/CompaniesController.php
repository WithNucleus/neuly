<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CompanyRequest;
use App\Models\Company;
use http\Env\Response;

class CompaniesController extends Controller
{
    private $hiddenFields = [
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

    private $allowedFields = [
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

    public function index()
    {
        $hiddenFields = $this->hiddenFields;
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
            'companies' => 'discover.organizations.show',
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
            ->map(function ($item) use ($hiddenFields, $entityShowRoutesMapping) {
                $item->url = route($entityShowRoutesMapping['companies'], $item->slug);
                $item->imageUrl = $item->entityImageUrl ? url($item->entityImageUrl) : null;

                foreach ($item->getRelations() as $relationName => $relationItems) {
                    $relationItems->map(function ($relationItem) use ($relationName, $entityShowRoutesMapping) {

                        if (isset($entityShowRoutesMapping[$relationName]) && isset($relationItem->slug)) {
                            $relationItem->url = route($entityShowRoutesMapping[$relationName], $relationItem->slug);
                            $relationItem->makeHidden('slug');
                        }

                        //Eloquent issue: without selecting "owner_id" no records will be retrieved
                        if ($relationName == 'jobs') {
                            $relationItem->makeHidden('owner_id');
                        }

                        $relationItem->makeHidden('pivot');
                    });
                }

                $item->makeHidden($hiddenFields);

                return $item;
            });

        return response()->json($data);
    }

    public function show($id)
    {
    }

    public function create(CompanyRequest $request)
    {
        $data = $this->filterRequestData($request->all());

        try {
            $entity = Company::create($data);
        } catch (\Throwable $throwable) {
            return response()->json(['status' => 'Error', 'message' => $throwable->getMessage()]);
        }

        $entity->url = route('discover.organizations.show', $entity->slug);
        $entity->imageUrl = $entity->entityImageUrl ? url($entity->entityImageUrl) : null;
        $entity->makeHidden($this->hiddenFields);

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

        $entity->url = route('discover.organizations.show', $entity->slug);
        $entity->imageUrl = $entity->entityImageUrl ? url($entity->entityImageUrl) : null;
        $entity->makeHidden($this->hiddenFields);

        return response()->json([
            'status' => 'Success',
            'message' => 'Organization updated.',
            'data' => $entity,
        ]);
    }

    //TODO made this method common between API controllers
    private function filterRequestData($requestArray)
    {
        return array_intersect_key($requestArray, array_flip($this->allowedFields));
    }
}
