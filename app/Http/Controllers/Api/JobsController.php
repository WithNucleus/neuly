<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Job;

class JobsController extends Controller
{
    public function index()
    {
        $hiddenFields = [
            'slug',
            'created_at',
            'updated_at',
            'owner_id',
            'owner_type',
            'job_description',
            'owner',
        ];

        $relationsWithArray = [
            'owner',
            'focus' => function ($query) {
                return $query->select('name');
            },
            'locations' => function ($query) {
                return $query->select('name');
            },
        ];

        $data = Job::open()
            ->with($relationsWithArray)
            ->orderBy('posted_date', 'desc')
            ->get()
            ->map(function ($item) use ($hiddenFields) {
                $item->url = route('discover.jobs.show', $item->slug);
                $item->organization_name = $item->ownerName;
                $item->organization_url = $item->ownerShowUrl;

                foreach ($item->getRelations() as $relationName => $relationItems) {
                    if (in_array($relationName, ['focus', 'locations'])) {
                        $relationItems->map(function ($relationItem) use ($relationName) {
                            $relationItem->makeHidden('pivot');
                        });
                    }
                }

                $item->makeHidden($hiddenFields);

                return $item;
            });

        return response()->json($data);
    }
}
