<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\ClinicaltrialRequest;
use App\Models\Clinicaltrial;

class ClinicaltrialsController extends ApiBaseController
{
    protected $hiddenFields = [
        'slug',
        'created_at',
        'updated_at',
    ];

    protected $allowedFields = [
        'nct_number',
        'title',
        'acronym',
        'status',
        'study_results',
        'gender',
        'age',
        'phases',
        'phase_integer',
        'enrollment',
        'funded_bys',
        'study_type',
        'other_ids',
        'start_date',
        'primary_completion_date',
        'completion_date',
        'first_posted',
        'results_first_posted',
        'last_update_posted',
        'study_url',
        'brief_summary',
        'detailed_description',
        'min_age',
        'max_age',
    ];

    protected $showEntityRouteName = 'discover.clinicaltrials.show';

    public function index()
    {
        $relationsWithArray = [
            'focus' => function ($query) {
                return $query->select('name');
            },
            'locations' => function ($query) {
                return $query->select('name');
            },
            'companies' => function ($query) {
                return $query->select('name', 'slug');
            },
            'people' => function ($query) {
                return $query->select('name', 'slug');
            },
        ];
        $entityRelationsShowRoutes = [
            'companies' => 'discover.organizations.show',
            'people' => 'discover.people.show',
        ];

        $data = Clinicaltrial::with($relationsWithArray)
            ->get()
            ->map(function ($entity) use ($entityRelationsShowRoutes) {
                $this->prepareEntityForResponse($entity);

                //TODO make processing relations common function for all entities
                foreach ($entity->getRelations() as $relationName => $relationItems) {
                    $relationItems->map(function ($relationItem) use ($relationName, $entityRelationsShowRoutes) {
                        if (isset($entityRelationsShowRoutes[$relationName]) && isset($relationItem->slug)) {
                            $relationItem->url = route($entityRelationsShowRoutes[$relationName], $relationItem->slug);
                            $relationItem->makeHidden('slug');
                        }

                        $relationItem->makeHidden('pivot');
                    });
                }

                return $entity;
            });

        return response()->json($data);
    }

    public function create(ClinicaltrialRequest $request)
    {
        $data = $this->filterRequestData($request->all());

        try {
            $entity = Clinicaltrial::create($data);
        } catch (\Throwable $throwable) {
            return response()->json(['status' => 'Error', 'message' => $throwable->getMessage()]);
        }

        $this->prepareEntityForResponse($entity);

        return response()->json([
            'status' => 'Success',
            'message' => 'Clinical Trial created.',
            'data' => $entity,
        ]);
    }

    public function update(ClinicaltrialRequest $request, $id)
    {
        $entity = Clinicaltrial::find($id);

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
            'message' => 'Clinical Trial updated.',
            'data' => $entity,
        ]);
    }
}
