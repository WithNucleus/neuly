<?php

namespace App\Http\Controllers\Api;

use App\Enum\MediaTypes;
use App\Http\Requests\Api\MediaItemRequest;
use App\Models\MediaItem;
use Illuminate\Http\Request;

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

    public function index(Request $request)
    {
        $mediaType = null;

        if ($request->input('media_type') !== null) {
            $mediaType = $request->input('media_type');

            if (!in_array($mediaType, MediaTypes::MEDIA_TYPES)) {
                return response()->json(['message' => 'Wrong media type parameter!'], 400);
            }
        }

        $query = MediaItem::public()
            ->with($this->getRelationWithArray());

        if ($mediaType !== null) {
            $query->where('media_type', $mediaType);
        }

        $data = $query->orderBy('date', 'desc')
            ->get()
            ->map(function ($entity) {
                $this->prepareEntityForResponse($entity);
                $this->prepareEntityRelationsData($entity);

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

    public function show($id)
    {
        $entity = MediaItem::with($this->getRelationWithArray())->find($id);

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
