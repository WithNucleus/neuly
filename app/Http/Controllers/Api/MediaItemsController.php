<?php

namespace App\Http\Controllers\Api;

use App\Enum\MediaTypes;
use App\Http\Controllers\Controller;
use App\Models\MediaItem;

class MediaItemsController extends Controller
{
    public function index($mediaType = null)
    {
        if ($mediaType !== null) {
            $mediaType = ucfirst(str_replace('_', ' ', $mediaType));

            if (!in_array($mediaType, MediaTypes::MEDIA_TYPES)) {
                return response()->json(['message' => 'Wrong media type parameter!'], 400);
            }
        }

        $hiddenFields = [
            'id',
            'status',
            'source_type',
            'source_id',
            'created_at',
            'updated_at',
            'checked_at',
        ];

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
            ->map(function ($item) use ($hiddenFields, $entityShowRoutesMapping) {
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
}
