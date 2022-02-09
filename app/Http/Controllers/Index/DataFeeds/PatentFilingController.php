<?php

namespace App\Http\Controllers\Index\DataFeeds;

use App\Http\Controllers\Controller;
use App\Enum\MediaTypes;
use App\Models\Company;
use App\Models\Focus;
use App\Models\MediaItem;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PatentFilingController extends Controller
{
    public function __construct()
    {
        $this->middleware('query_filters')->only('index');
    }

    public function index()
    {
        $patentFilings = QueryBuilder::for(MediaItem::patentFilings()->public())
            ->with(['source'])
            ->allowedSorts([
                'name',
                'date'
            ])
            ->allowedFilters([
                AllowedFilter::partial('focus', 'focus.name'),
                AllowedFilter::partial('status', 'entityContent.content'),
                AllowedFilter::partial('people', 'people.name'),
                AllowedFilter::partial('company', 'companies.name'),
            ])
            ->defaultSort('-date')
            ->paginate(99)
            ->appends(request()->query());

        $focusCategories = Focus::whereHas('mediaItems', function (Builder $query) {
            $query->where('media_type', MediaTypes::MEDIA_TYPE_PATENT_FILING);
        })->orderBy('name')->pluck('name')->toArray();

        $organizations = Company::whereHas('mediaItems', function (Builder $query) {
            $query->where('media_type', MediaTypes::MEDIA_TYPE_PATENT_FILING);
        })->orderBy('name')->pluck('name')->toArray();

        return view('discover.data-feeds.patent-filings.index', compact('patentFilings', 'focusCategories', 'organizations'));
    }
}
