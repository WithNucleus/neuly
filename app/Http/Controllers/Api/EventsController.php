<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;

class EventsController extends Controller
{
    public function index()
    {
        $hiddenFields = [
            'id',
            'slug',
            'image',
            'event_url',
            'registration_url',
            'created_at',
            'updated_at',
        ];

        $relationsWithArray = [
            'companies' => function ($query) {
                return $query->select('name', 'slug');
            },
            'eventTypes' => function ($query) {
                return $query->select('name');
            },
            'focus' => function ($query) {
                return $query->select('name');
            },
            'locations' => function ($query) {
                return $query->select('name');
            },
        ];

        $events = Event::upcoming()
            ->with($relationsWithArray)
            ->orderBy('start_date', 'asc')
            ->get()
            ->map(function ($item) use ($hiddenFields) {
                $item->url = route('discover.events.show', $item->slug);
                $item->imageUrl = url($item->entityImageUrl);

                foreach ($item->getRelations() as $relationName => $relationItems) {
                    $relationItems->map(function ($relationItem) use ($relationName) {
                        if ($relationName == 'companies') {
                            $relationItem->url = route('discover.organizations.show', $relationItem->slug);
                            $relationItem->makeHidden('slug');
                        }

                        $relationItem->makeHidden('pivot');
                    });
                }

                $item->makeHidden($hiddenFields);

                return $item;
            });

        return response()->json($events);
    }
}
