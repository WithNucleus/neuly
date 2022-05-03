<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\PersonRequest;
use App\Models\Person;

class PeopleController extends ApiBaseController
{
    protected $hiddenFields = [
        'slug',
        'email',
        'secondary_email',
        'photo',
        'visibility',
        'visibility_code',
        'created_at',
        'updated_at',
        'user_id',
        'twitter_followers',
        'instagram_followers',
    ];

    protected $allowedFields = [
        'name',
        'website',
        'facebook',
        'instagram',
        'linkedin',
        'twitter',
        'google_scholar',
        'bio',
        'published_works',
        'byline',
        'job_type',
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
            'companies' => function ($query) {
                return $query->select('name', 'slug');
            },
            'research' => function ($query) {
                return $query->select('name', 'slug');
            },
            'events' => function ($query) {
                return $query->upcoming()->select('name', 'slug');
            },
            'clinicaltrials' => function ($query) {
                return $query->select('title', 'slug');
            },
        ];
        $entityShowRoutesMapping = [
            'companies' => 'discover.organizations.show',
            'investors' => 'discover.investors.show',
            'research' => 'discover.research.show',
            'events' => 'discover.events.show',
            'clinicaltrials' => 'discover.clinicaltrials.show',
        ];

        $data = Person::public()
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

                        $relationItem->makeHidden('pivot');
                    });
                }

                return $entity;
            });

        return response()->json($data);
    }

    public function create(PersonRequest $request)
    {
        $data = $this->filterRequestData($request->all());

        try {
            $entity = Person::create($data);
        } catch (\Throwable $throwable) {
            return response()->json(['status' => 'Error', 'message' => $throwable->getMessage()]);
        }

        $this->prepareEntityForResponse($entity);

        return response()->json([
            'status' => 'Success',
            'message' => 'Person created.',
            'data' => $entity,
        ]);
    }

    public function update(PersonRequest $request, $id)
    {
        $entity = Person::find($id);

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
            'message' => 'Person updated.',
            'data' => $entity,
        ]);
    }
}
