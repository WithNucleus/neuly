<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\ResearchRequest;
use App\Models\Research;

class ResearchController extends ApiBaseController
{
    protected $hiddenFields = [
        'slug',
        'api_identifier',
        'created_at',
        'updated_at',
    ];

    protected $allowedFields = [
        'name',
        'abstract',
        'link',
        'publish_date',
        'publication_info',
        'resources',
    ];

    protected $showEntityRouteName = 'discover.research.show';

    public function index()
    {
        $relationsWithArray = [
            'focus' => function ($query) {
                return $query->select('name');
            },
            'companies' => function ($query) {
                return $query->select('name', 'slug');
            },
            'people' => function ($query) {
                return $query->select('name', 'slug');
            },
        ];
        $entityShowRoutesMapping = [
            'companies' => 'discover.organizations.show',
            'people' => 'discover.people.show',
        ];

        $data = Research::with($relationsWithArray)
            ->get()
            ->map(function ($entity) use ($entityShowRoutesMapping) {
                $this->prepareEntityForResponse($entity);

                foreach ($entity->getRelations() as $relationName => $relationItems) {
                    $relationItems->map(function ($relationItem) use ($relationName, $entityShowRoutesMapping) {
                        if (isset($entityShowRoutesMapping[$relationName]) && isset($relationItem->slug)) {
                            $relationItem->url = route($entityShowRoutesMapping[$relationName], $relationItem->slug);
                            $relationItem->makeHidden('slug');
                        }

                        $relationItem->makeHidden('pivot');
                    });
                }

                return $entity;
            });

        return response()->json($data);
    }

    public function create(ResearchRequest $request)
    {
        $data = $this->filterRequestData($request->all());

        try {
            $entity = Research::create($data);
        } catch (\Throwable $throwable) {
            return response()->json(['status' => 'Error', 'message' => $throwable->getMessage()]);
        }

        $this->prepareEntityForResponse($entity);

        return response()->json([
            'status' => 'Success',
            'message' => 'Research created.',
            'data' => $entity,
        ]);
    }

    public function update(ResearchRequest $request, $id)
    {
        $entity = Research::find($id);

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
            'message' => 'Research updated.',
            'data' => $entity,
        ]);
    }
}
