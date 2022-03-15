<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Person;

class PeopleController extends Controller
{
    public function index()
    {
        $hiddenFields = [
            'id',
            'slug',
            'photo',
            'visibility',
            'visibility_code',
            'created_at',
            'updated_at',
            'user_id',
        ];

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
}
