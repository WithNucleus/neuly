<?php

namespace App\Http\Controllers\Api;

use App\Models\BookableListing;
use App\Models\Directory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BookableListingsController extends ApiBaseController
{
    protected $hiddenFields = [
        'status',
        'company_branch_id',
        'bookable_id',
        'bookable_type',
        'user_id',
        'location_id',
        'hours_json'
    ];

    protected $allowedFields = [
        'name',
        'type',
        'slug',
        'content'
    ];

    protected $showEntityRouteName = 'discover.bookable-listing.show';

    public function index(Request $request)
    {
        $directory = null;

        if ($request->input('directory') !== null) {
            $directory = Directory::where('name', $request->input('directory'))->first();

            if (!$directory) {
                return response()->json(['message' => 'Invalid directory'], 400);
            }
        }

        $query = BookableListing::public()
            ->practitioners()
            ->with($this->getRelationWithArray());

        if ($directory) {
            $query->whereHas('directories', function (Builder $query) use ($directory) {
                $query->where('name', $directory->name);
            });
        }

        // TODO: Add date filtering

        $data = $query->orderByDesc('updated_at')
            ->get()
            ->map(function ($entity) {
                $this->prepareEntityRelationsData($entity);
                $this->prepareEntityForResponse($entity);

                return $entity;
            });

        return response()->json($data);
    }

    private function getRelationWithArray()
    {
        return [
            'focus' => function ($query) {
                return $query->select('name');
            },
            'directories' => function ($query) {
                return $query->select('name', 'url_prefix');
            },
            'content' => function ($query) {
                return $query->select('entity_id', 'name', 'content');
            },
        ];
    }
}
