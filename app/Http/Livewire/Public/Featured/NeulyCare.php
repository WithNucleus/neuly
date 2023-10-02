<?php

namespace App\Http\Livewire\Public\Featured;

use App\Http\Livewire\Public\Traits\LocalLocationFilter;
use App\Http\Livewire\Traits\WithBulkActions;
use App\Http\Livewire\Traits\WithCachedRows;
use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\BookableListing;
use App\Models\CareRequest;
use App\Models\EduRequest;
use App\Models\Focus;
use App\Models\SearchLog;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NeulyCare extends Component
{
    use WithPerPagePagination, WithBulkActions, WithCachedRows, WithSorting, LocalLocationFilter;

    protected string $paginationTheme = 'bootstrap';
    protected $queryString = ['search', 'find'];
    protected $listeners = ['neulyCareGeoSearch', 'clearSearchLocation'];

    public ?string $search = null;
    public ?string $find = null;

    public array $filters = [
        'focus' => [],
        'type' => [],
        'entity-state' => []
    ];

    public string $ip;
    public ?int $userId = null;

    public bool $telehealth = false;

    public int $locationDistance = 1500;

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

    public $name;
    public $email;
    public $message;
    public bool $conciergeSuccess = false;

    public function mount(Request $request) {

        $this->getLocalLocation();
        $this->setCustomSearches();

         $this->ip = $request->getClientIp(); // PRODUCTION
         // $this->ip = '207.46.13.74'; // TEST - Chicago
         // $this->ip = "108.92.170.181"; // Sydney

        $this->sorts = [
            'updated_at' => 'desc'
        ];

        if (Auth::id()) {
            $user = User::findOrFail(Auth::id());
            $this->userId = $user->id;
            $this->name = $user->full_name;
            $this->email = $user->email;
        }
    }

    public function setCustomSearches() {
        if($this->find === 'retreats') {
            $this->filters['type'] = [BookableListing::TYPE_RETREAT];
        }

        if ($this->find === 'telehealth') {
            $this->telehealth = true;
        }

        if ($this->find === 'ketamine-clinics') {
            $this->filters['focus'] = ['Ketamine'];
            $this->filters['type'] = [BookableListing::TYPE_CLINIC];
        }

        if ($this->find === 'oregon-psilocybin') {
            $this->filters['focus'] = ['Psilocybin'];
            $this->filters['entity-state'] = ['Oregon'];
            $this->localLocation = [
                'latitude' => null,
                'longitude' => null,
                'name' => null,
                'id' => null
            ];
        }

        $this->reset('find');
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
        $this->resetPage();
    }

    public function clearLocalLocation() {
        $this->reset('localLocation');
        $this->resetPage();
    }

    public function clearSearchLocation() {
        $this->reset('searchLocation');
        $this->resetPage();
    }

    public function clearFilters() {
        $this->reset('search');
        $this->reset('filters');
        $this->reset('sorts');
        $this->reset('localLocation');
        $this->reset('searchLocation');
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

        $this->resetPage();
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
                'telehealth' => $this->telehealth,
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

    public function rules() {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ];
    }

    public function submit() {
        $this->validate();

        CareRequest::create([
            'name' => $this->name,
            'email' => $this->email,
            'type' => CareRequest::TYPE_PRACTITIONER_NO_MATCHES,
            'status' => CareRequest::STATUS_OPEN,
            'message' => $this->message,
            'data' => [
                'search' => $this->search,
                'filters' => $this->filters,
                'locations' => [
                    'local' => $this->localLocation,
                ]
            ],
            'user_id' => $this->userId,
            'ip' => $this->ip,
        ]);

        $this->conciergeSuccess = true;
        $this->reset('message');
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
                ->when($this->telehealth, function($query) {
                    return $query->where('virtual', 1);
                })
                ->when($this->localLocation['latitude'], function($query) {
                    return $query->distance($this->localLocation['latitude'], $this->localLocation['longitude'], $this->locationDistance);
                })
                ->when($this->searchLocation['latitude'], function($query) {
                    return $query->distance($this->searchLocation['latitude'], $this->searchLocation['longitude'], $this->locationDistance);
                })
                ->when($this->filters['entity-state'], function($query, $valueArray) {
                    return $query->whereHas('location', function($query) use ($valueArray) {
                        $query->whereIn('region', $valueArray);
                    });
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
        return view('livewire.public.featured.neuly-care', [
            'records' => $this->rows,
            'typeOptions' => BookableListing::TYPES_CARE,
            'focusOptions' => Focus::drugs()->whereHas('bookableListings')->withCount('bookableListings')->orderByDesc('bookable_listings_count')->get()->toArray()
        ]);
    }
}
