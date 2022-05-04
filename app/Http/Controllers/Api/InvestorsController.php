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
        $data = Investor::with($this->getRelationWithArray())
            ->get()
            ->map(function ($entity) {
                $this->prepareEntityRelationsData($entity);
                $this->prepareEntityForResponse($entity);

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

    public function show($id)
    {
        $entity = Investor::with($this->getRelationWithArray())->find($id);

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
    }
}
