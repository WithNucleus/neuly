<?php

namespace App\Http\Livewire\Public\Entities;

use App\Http\Livewire\Traits\WithBulkActions;
use App\Http\Livewire\Traits\WithCachedRows;
use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\BookableListing;
use App\Models\Focus;
use App\Models\SearchLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class BookableListingsIndex extends Component
{
    use WithPerPagePagination, WithBulkActions, WithCachedRows, WithSorting;

    protected string $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];
    protected $listeners = ['neulyCareGeoSearch', 'clearSearchLocation'];

    public ?string $search = null;

    public array $filters = [
        'focus' => [],
        'type' => []
    ];

    public string $ip;
    public ?int $userId;

    public bool $virtual = false;

    public array $localLocation = [
        'latitude' => null,
        'longitude' => null,
        'name' => null,
        'id' => null
    ];

    public array $searchLocation = [
        'latitude' => null,
        'longitude' => null,
        'name' => null,
        'id' => null
    ];

    public array $savedLocations = [];

    public function mount(Request $request) {

//         $this->ip = $request->getClientIp(); // PRODUCTION
        // $this->ip = '207.46.13.74'; // TEST - Chicago
        $this->ip = "108.92.170.181"; // Sydney

        $this->getLocalLocation();

        $this->sorts = [
            'updated_at' => 'desc'
        ];

        if (Auth::id()) {
            $this->userId = Auth::id();
        }
    }

    private function getLocalLocation() {

        $ipRequest = Http::get('https://ipapi.co/' . $this->ip . '/json');
        $ipResponse = json_decode($ipRequest->body(), true);

        if (array_key_exists('error', $ipResponse)) {
            Log::info('Error with Neuly Care IP Response', $ipResponse);
        } else {
            $thisLocation = [];

            if (array_key_exists('latitude', $ipResponse) AND array_key_exists('longitude', $ipResponse)) {
               $this->localLocation['latitude'] = $ipResponse['latitude'];
               $this->localLocation['longitude'] = $ipResponse['longitude'];

               $thisLocation['latitude'] = $ipResponse['latitude'];
               $thisLocation['longitude'] = $ipResponse['longitude'];
            }

            if (array_key_exists('city', $ipResponse)) {
               $this->localLocation['name'] = $ipResponse['city'];
               $thisLocation['name'] = $ipResponse['city'];
            }

            $this->savedLocations[] = $thisLocation;
        }

    }

    public function updatingSearch() {
        $this->resetPage();
    }

    public function updatingFilters() {
        $this->resetPage();
    }

    public function clearSearch() {
        $this->reset('search');
        $this->resetPage();
    }

    public function clearFilter($filter, $id) {
        unset($this->filters[$filter][$id]);
    }

    public function clearLocalLocation() {
        $this->reset('localLocation');
    }

    public function clearSearchLocation() {
        $this->reset('searchLocation');
    }

    public function clearFilters() {
        $this->reset('search');
        $this->reset('filters');
        $this->reset('sorts');
        $this->resetPage();
    }

    public function neulyCareGeoSearch($locationName, $latitude, $longitude) {
        $this->searchLocation['latitude'] = $latitude;
        $this->searchLocation['longitude'] = $longitude;
        $this->searchLocation['name'] = $locationName;

        $this->savedLocations[] = [
            'type' => 'geosearch',
            'latitude' => $latitude,
            'longitude' => $longitude,
            'name' => $locationName
        ];
    }

    public function goListing($id) {
        $listing = BookableListing::find($id);

        SearchLog::create([
            'term' => $this->search ?? 'empty',
            'type' => SearchLog::TYPE_NEULY_CARE,
            'ip' => $this->ip,
            'location_id' => $this->searchLocation['id'],
            'data' => [
                'filters' => $this->filters,
                'virtual' => $this->virtual,
                'locations' => [
                    'local' => $this->localLocation,
                    'saved' => $this->savedLocations
                ]
            ],
            'relatable_type' => BookableListing::class,
            'relatable_id' => $listing->id,
            'user_id' => $this->userId
        ]);

        $this->dispatchBrowserEvent('go-to-listing', ['url' => $listing->bookable_url]);

    }

    public function gotoPage($page)
    {
        $this->setPage($page);
        $this->emit('gotoTop');
    }

    public function nextPage()
    {
        $this->setPage($this->page + 1);
        $this->emit('gotoTop');
    }

    public function previousPage()
    {
        $this->setPage(max($this->page - 1, 1));
        $this->emit('gotoTop');
    }

    public function getRowsQueryProperty()
    {
        $query = BookableListing::public()->with([
                    'focusDrugs',
                    'bookable',
                    'location'
                ])
                ->when($this->search, function($query, $search) {
                    return $query->public()->where(function ($query) use ($search) {
                        return $query
                            ->where('name', 'like', '%' . $search . '%')
                            ->orWhere('address', 'like', '%' . $search . '%')
                            ->orWhere('location_name', 'like', '%' . $search . '%')
                            ->orwhereHas('focus', function($query) use ($search) {
                                $query->where('name', 'like', '%' . $search . '%');
                            })
                            ->orwhereHas('bookable', function($query) use ($search) {
                                $query->where('name', 'like', '%' . $search . '%');
                            })
                            ->orwhereHas('location', function($query) use ($search) {
                                $query->where('name', 'like', '%' . $search . '%');
                            });
                   });
                })
                ->when($this->filters['focus'], function($query, $valueArray) {
                    return $query->whereHas('focus', function($query) use ($valueArray) {
                        $query->whereIn('name', $valueArray);
                    });
                })
                ->when($this->filters['type'], function($query, $valueArray) {
                    return $query->whereIn('type', $valueArray);
                })
                ->when($this->virtual, function($query) {
                    return $query->where('virtual', 1);
                })
                ->when($this->localLocation['latitude'], function($query) {
                    return $query->distance($this->localLocation['latitude'], $this->localLocation['longitude'], 100);
                })
                ->when($this->searchLocation['latitude'], function($query) {
                    return $query->distance($this->searchLocation['latitude'], $this->searchLocation['longitude'], 100);
                });

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->cache(function () {
            return $this->applyPagination($this->rowsQuery);
        });
    }

    public function render()
    {
        return view('livewire.public.entities.bookable-listings-index', [
            'records' => $this->rows,
            'typeOptions' => BookableListing::TYPES_CARE,
            'focusOptions' => Focus::drugs()->whereHas('bookableListings')->withCount('bookableListings')->orderByDesc('bookable_listings_count')->get()->toArray()
        ]);
    }
}
