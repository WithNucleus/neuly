<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Investor;

class InvestorsController extends Controller
{
    public function index()
    {
        $hiddenFields = [
            'slug',
            'logo',
            'created_at',
            'updated_at',
        ];

        $relationsWithArray = [
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

        $entityShowRoutesMapping = [
            'investors' => 'discover.investors.show',
            'companies' => 'discover.organizations.show',
            'people' => 'discover.people.show',
            'jobs' => 'discover.jobs.show',
        ];

        $data = Investor::with($relationsWithArray)
            ->get()
            ->map(function ($item) use ($hiddenFields, $entityShowRoutesMapping) {
                $item->url = route($entityShowRoutesMapping['investors'], $item->slug);
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
