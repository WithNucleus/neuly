<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;

class CompaniesController extends Controller
{
    public function index()
    {
        $hiddenFields = [
            'id',
            'slug',
            'logo',
            'visibility',
            'visibility_code',
            'created_at',
            'updated_at',
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
            'people' => function ($query) {
                return $query->select('name', 'slug');
            },
            'research' => function ($query) {
                return $query->select('name', 'slug');
            },
            'jobs' => function ($query) {
                return $query->open()->select('owner_id', 'job_title', 'slug');
            },
            'events' => function ($query) {
                return $query->upcoming()->select('name', 'slug');
            },
            'clinicaltrials' => function ($query) {
                return $query->select('title', 'slug');
            },
            'parents' => function ($query) {
                return $query->select('name');
            },
            'subsidiaries' => function ($query) {
                return $query->select('name');
            },
        ];

        $entityShowRoutesMapping = [
            'companies' => 'discover.organizations.show',
            'investors' => 'discover.investors.show',
            'people' => 'discover.people.show',
            'research' => 'discover.research.show',
            'events' => 'discover.events.show',
            'jobs' => 'discover.jobs.show',
            'clinicaltrials' => 'discover.clinicaltrials.show',
        ];

        $data = Company::public()
            ->with($relationsWithArray)
            ->get()
            ->map(function ($item) use ($hiddenFields, $entityShowRoutesMapping) {
                $item->url = route($entityShowRoutesMapping['companies'], $item->slug);
                $item->imageUrl = $item->entityImageUrl ? url($item->entityImageUrl) : null;

                foreach ($item->getRelations() as $relationName => $relationItems) {
                    $relationItems->map(function ($relationItem) use ($relationName, $entityShowRoutesMapping) {

                        if (isset($entityShowRoutesMapping[$relationName]) && isset($relationItem->slug)) {
                            $relationItem->url = route($entityShowRoutesMapping[$relationName], $relationItem->slug);
                            $relationItem->makeHidden('slug');
                        }

                        //Eloquent issue: without selecting "owner_id" no records will be retrieved
                        if ($relationName == 'jobs') {
                            $relationItem->makeHidden('owner_id');
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
