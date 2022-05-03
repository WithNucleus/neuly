<?php

namespace App\Http\Controllers\Api;

use App\Enum\MediaTypes;
use App\Http\Requests\Api\MediaItemRequest;
use App\Models\MediaItem;

class MediaItemsController extends ApiBaseController
{
    protected $hiddenFields = [
        'status',
        'source_type',
        'source_id',
        'created_at',
        'updated_at',
        'checked_at',
    ];

    protected $allowedFields = [
        'name',
        'media_type',
        'url',
        'summary',
        'content',
        'date',
        'icon_url',
    ];

    public function index($mediaType = null)
    {
        if ($mediaType !== null) {
            $mediaType = ucfirst(str_replace('_', ' ', $mediaType));

            if (!in_array($mediaType, MediaTypes::MEDIA_TYPES)) {
                return response()->json(['message' => 'Wrong media type parameter!'], 400);
            }
        }

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

        $query = MediaItem::public()
            ->with($relationsWithArray);

        if ($mediaType !== null) {
            $query->where('media_type', $mediaType);
        }

        $data = $query->orderBy('date', 'desc')
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

    public function create(MediaItemRequest $request)
    {
        $data = $this->filterRequestData($request->all());

        try {
            $entity = MediaItem::create($data);
        } catch (\Throwable $throwable) {
            return response()->json(['status' => 'Error', 'message' => $throwable->getMessage()]);
        }

        $this->prepareEntityForResponse($entity);

        return response()->json([
            'status' => 'Success',
            'message' => 'Media Item created.',
            'data' => $entity,
        ]);
    }

    public function update(MediaItemRequest $request, $id)
    {
        $entity = MediaItem::find($id);

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
            'message' => 'Media Item updated.',
            'data' => $entity,
        ]);
    }
}
