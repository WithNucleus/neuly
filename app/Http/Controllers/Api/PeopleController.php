<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PersonRequest;
use App\Models\Person;

class PeopleController extends Controller
{
    private $hiddenFields = [
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

    private $allowedFields = [
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
            'people' => 'discover.people.show',
            'research' => 'discover.research.show',
            'events' => 'discover.events.show',
            'clinicaltrials' => 'discover.clinicaltrials.show',
        ];

        $data = Person::public()
            ->with($relationsWithArray)
            ->get()
            ->map(function ($item) use ($hiddenFields, $entityShowRoutesMapping) {
                $item->url = route($entityShowRoutesMapping['people'], $item->slug);
                $item->imageUrl = $item->entityImageUrl ? url($item->entityImageUrl) : null;

                foreach ($item->getRelations() as $relationName => $relationItems) {
                    $relationItems->map(function ($relationItem) use ($relationName, $entityShowRoutesMapping) {

                        if (isset($entityShowRoutesMapping[$relationName]) && isset($relationItem->slug)) {
                            $relationItem->url = route($entityShowRoutesMapping[$relationName], $relationItem->slug);
                            $relationItem->makeHidden('slug');
                        }

                        $relationItem->makeHidden('pivot');
                    });
                }

                $item->makeHidden($hiddenFields);

                return $item;
            });

        return response()->json($data);
    }

    public function create(PersonRequest $request)
    {
        $data = $this->filterRequestData($request->all());

        try {
            $entity = Person::create($data);
        } catch (\Throwable $trowable) {
            return response()->json(['status' => 'Error', 'message' => $trowable->getMessage()]);
        }

        $entity->url = route('discover.people.show', $entity->slug);
        $entity->imageUrl = $entity->entityImageUrl ? url($entity->entityImageUrl) : null;
        $entity->makeHidden($this->hiddenFields);

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
        } catch (\Throwable $trowable) {
            return response()->json(['status' => 'Error', 'message' => $trowable->getMessage()]);
        }

        $entity->url = route('discover.people.show', $entity->slug);
        $entity->imageUrl = $entity->entityImageUrl ? url($entity->entityImageUrl) : null;
        $entity->makeHidden($this->hiddenFields);

        return response()->json([
            'status' => 'Success',
            'message' => 'Organization updated.',
            'data' => $entity,
        ]);
    }

    private function filterRequestData($requestArray)
    {
        return array_intersect_key($requestArray, array_flip($this->allowedFields));
    }
}
