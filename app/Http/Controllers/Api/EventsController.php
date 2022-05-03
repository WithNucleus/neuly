<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\EventRequest;
use App\Models\Event;

class EventsController extends ApiBaseController
{
    protected $hiddenFields = [
        'slug',
        'image',
        'event_url',
        'registration_url',
        'created_at',
        'updated_at',
    ];

    protected $allowedFields = [
        'name',
        'start_date',
        'end_date',
        'description',
    ];

    protected $showEntityRouteName = 'discover.events.show';

    public function index()
    {
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
        $entityRelationsShowRoutes = [
            'companies' => 'discover.organizations.show',
        ];

        $events = Event::upcoming()
            ->with($relationsWithArray)
            ->orderBy('start_date', 'asc')
            ->get()
            ->map(function ($entity) use ($entityRelationsShowRoutes) {
                $this->prepareEntityForResponse($entity);

                foreach ($entity->getRelations() as $relationName => $relationItems) {
                    $relationItems->map(function ($relationItem) use ($relationName,$entityRelationsShowRoutes) {
                        if (isset($entityShowRoutesMapping[$relationName]) && isset($relationItem->slug)) {
                            $relationItem->url = route($entityRelationsShowRoutes[$relationName], $relationItem->slug);
                            $relationItem->makeHidden('slug');
                        }

                        $relationItem->makeHidden('pivot');
                    });
                }

                return $entity;
            });

        return response()->json($events);
    }

    public function create(EventRequest $request)
    {
        $data = $this->filterRequestData($request->all());

        try {
            $entity = Event::create($data);
        } catch (\Throwable $throwable) {
            return response()->json(['status' => 'Error', 'message' => $throwable->getMessage()]);
        }

        $this->prepareEntityForResponse($entity);

        return response()->json([
            'status' => 'Success',
            'message' => 'Event created.',
            'data' => $entity,
        ]);
    }

    public function update(EventRequest $request, $id)
    {
        $entity = Event::find($id);

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
            'message' => 'Event updated.',
            'data' => $entity,
        ]);
    }
}
