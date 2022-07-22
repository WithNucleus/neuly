<?php

namespace App\Http\Controllers\Admin\DataFeeds;

use App\Http\Controllers\Controller;
use App\Models\DataFeed;
use App\Models\MediaItem;
use App\Models\Scopes\PublicStatusScope;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Database\Eloquent\Builder;

class DashboardController extends Controller
{
    public function index(Request $request) {

        $filter = $request->query('filter');
        $pagination = $request->query('pagination') ?? 25;

        $mediaItems = QueryBuilder::for(MediaItem::class)
            ->withoutGlobalScope(PublicStatusScope::class)
            ->pending()
            ->allowedFilters([
                'name',
                'media_type',
                AllowedFilter::exact('source', 'source.name'),
            ])
            ->allowedSorts([
                'name',
                'date',
                'media_type'
            ])
            ->defaultSort('-date')
            ->paginate($pagination)
            ->appends(request()->query());

        $dataFeedQuery = DataFeed::whereHas('mediaItems', function (Builder $query) {
            $query->where('status', MediaItem::STATUS_PENDING);
        })->withCount([
            'mediaItems' => function($query) {
                $query->where('status', MediaItem::STATUS_PENDING);
            }
        ]);

        $dataFeeds = $dataFeedQuery->orderBy('name')->get();
        $sources = $dataFeeds->pluck('media_items_count', 'name')->toArray();
        $mediaTypes = $dataFeeds->pluck('media_type')->unique()->toArray();

        return view('admin.data-feeds.dashboard', compact('mediaItems', 'filter', 'pagination', 'sources', 'mediaTypes'));
    }

    public function update($id, Request $request): \Illuminate\Http\JsonResponse
    {
        $mediaItem = MediaItem::withoutGlobalScope(PublicStatusScope::class)->find($id);

        $response = [
            'status' => 'success',
        ];

        if ($request->input('status') === MediaItem::STATUS_PUBLIC) {
            $response['message'] = 'Approved';
        } else {
            $response['message'] = 'Declined';
        }

        if ($mediaItem) {
            $mediaItem->status = $request->input('status');

            if ($request->input('type')) {
                $mediaItem->media_type = $request->input('type');
            }

            $mediaItem->save();

            $response['message'] .= ' ' . $mediaItem->name;
        } else {
            $response['status'] = 'error';
            $response['message'] = 'This item could not be found. It was either deleted or there is a problem.';
        }

        return response()->json($response);
    }
}
