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
        $data = Research::with($this->getRelationWithArray())
            ->get()
            ->map(function ($entity) {
                $this->prepareEntityRelationsData($entity);
                $this->prepareEntityForResponse($entity);

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

    public function show($id)
    {
        $entity = Research::with($this->getRelationWithArray())->find($id);

        if ($entity === null) {
            return response()->json(['message' => 'Record not found.'], 404);
        }

        $this->prepareEntityRelationsData($entity);
        $this->prepareEntityForResponse($entity);

        return response()->json($entity);
    }

    private function getRelationWithArray()
    {
        return [
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
    }
}
