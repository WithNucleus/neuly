<?php

namespace App\Http\Livewire\Public\Entities;

use App\Models\BookableListing;
use App\Models\Focus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;
use Throwable;

class NeulyCare extends Component
{
    use WithPagination;
    protected string $paginationTheme = 'bootstrap';

    protected $listeners = ['geoSearchLocation', 'geoSearchCoordinates', 'clearGeoSearch'];

    protected $queryString = ['latitude', 'longitude'];

    public $perPage = 10;

    public $location = null;
    public $showResults = false;

    public $ip = null;

    public $ipLatitude = null;
    public $ipLongitude = null;

    public $latitude = null;
    public $longitude = null;

    public $virtual = false;

    public $savedLocation = [
        'latitude' => null,
        'longitude' => null,
        'location' => null
    ];

    public array $filters = [
        'selected-treatments' => [],
        'selected-conditions' => [],
        'selected-services' => [],
        'virtual' => null
    ];

    public function mount(Request $request) {
//        $this->ip = $request->getClientIp(); // PRODUCTION
        $this->ip = '207.46.13.74'; // Chicago

        if ($this->latitude AND $this->longitude) {
            $this->showResults = true;

            if (!$this->location) {
                try {
                    $openCageUrl = 'https://api.opencagedata.com/geocode/v1/json?q=' .
                        $this->latitude . '+' . $this->longitude .
                        '&key=' . config('services.opencage.geocoding_api_key') .
                        '&limit=1&abbrv=1';

                    $locationNameRequest = Http::get($openCageUrl);
                    $response = json_decode($locationNameRequest->body(), true);
                    $locationResponse = $response['results'][0]['components'];

//                    echo '<textarea class="form-control">';
//                    print_r($locationResponse);
//                    echo '</textarea>';

                    $locationArray = [];

                    if (array_key_exists('city', $locationResponse)) {
                        $locationArray[] = $locationResponse['city'];
                    }

                    if (array_key_exists('state', $locationResponse)) {
                        $locationArray[] = $locationResponse['state'];
                    }

                    if (array_key_exists('postcode', $locationResponse)) {
                        $locationArray[] = $locationResponse['postcode'];
                    }

                    if (array_key_exists('country', $locationResponse)) {

                        if ($locationResponse['country'] === 'United States') {
                            $locationArray[] = 'USA';
                        } else {
                            $locationArray[] = $locationResponse['country'];
                        }
                    }

                    $this->location = implode(', ', $locationArray);

                } catch (Throwable $throwable) {
                    // TODO: Log / Slack Alert
                    Log::emergency('opencagedata ip lookup not working' . "\n" . $throwable->getMessage());
                }
            }

        } else {
            try {

                $ipRequest = Http::get('https://ipapi.co/' . $this->ip . '/json');
                $ipResponse = json_decode($ipRequest->body(), true);

                if (array_key_exists('latitude', $ipResponse) AND array_key_exists('longitude', $ipResponse)) {
                   $this->ipLatitude = $ipResponse['latitude'];
                   $this->ipLongitude = $ipResponse['longitude'];
                }

                if (array_key_exists('city', $ipResponse)) {
                   $this->location = $ipResponse['city'];
                }

                if ($this->ipLatitude AND $this->ipLongitude) {
                   $this->showResults = true;
                }

            } catch(Throwable $throwable) {
                // TODO: Log / Slack Alert
                Log::emergency('Cant get info from ipapi.co' . "\n" . $throwable->getMessage());
            }
        }
    }

    public function updatingFilters()
    {
        $this->showResults = true;
        $this->resetPage();
    }

    public function updatingVirtual($value) {

        if ($value === true) {
            $this->savedLocation['latitude'] = $this->latitude ?? $this->ipLatitude;
            $this->savedLocation['longitude'] = $this->longitude ?? $this->ipLongitude;
            $this->savedLocation['location'] = $this->location ?? 'your location';
            $this->reset('ipLatitude');
            $this->reset('ipLongitude');
            $this->reset('latitude');
            $this->reset('longitude');
            $this->reset('location');
        } else {
            $this->latitude = $this->savedLocation['latitude'];
            $this->longitude = $this->savedLocation['longitude'];
            $this->location = $this->savedLocation['location'];
            $this->reset('savedLocation');
        }
    }

    public function resetFilters() {
        $this->reset('filters');
    }

    public function resetFilter($filter) {
        $this->filters[$filter] = null;
    }

    public function resetFilterArray($filter) {
        $this->filters[$filter] = [];
    }

    public function render()
    {
        return view('livewire.public.entities.neuly-care', [
            'optionsTreatments' => Focus::drugs()->pluck('name')->unique()->toArray(),
            'optionsConditions' => Focus::other()->pluck('name')->unique()->toArray(),
            'optionsServices' => Focus::drugs()->pluck('name')->unique()->toArray(),
            'listings' => BookableListing::public()->orderByDesc('updated_at')
                ->with(['focus', 'bookable'])
                ->when($this->virtual, function($query) {
                    return $query->where('virtual', 1);
                })
                ->when($this->ipLatitude, function($query) {
                    return $query->distance($this->ipLatitude, $this->ipLongitude, 100);
                })
                ->when($this->latitude, function($query) {
                    return $query->distance($this->latitude, $this->longitude, 100);
                })
                ->when($this->filters['selected-treatments'], function($query, $selectedOptions) {
                    return $query->whereHas('tags', function($query) use ($selectedOptions) {
                        $query->whereIn('name', $this->filters['selected-treatments']);
                    });
                })
                ->when($this->filters['selected-conditions'], function($query, $selectedOptions) {
                    return $query->whereHas('tags', function($query) use ($selectedOptions) {
                        $query->whereIn('name', $this->filters['selected-conditions']);
                    });
                })
                ->when($this->filters['selected-services'], function($query, $selectedOptions) {
                    return $query->whereHas('tags', function($query) use ($selectedOptions) {
                        $query->whereIn('name', $this->filters['selected-services']);
                    });
                })
                ->paginate($this->perPage)
        ]);
    }

    public function geoSearchLocation($locationName, $latitude, $longitude) {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->location = $locationName;
        $this->ipLatitude = null;
        $this->ipLongitude = null;
        $this->showResults = true;
    }

    public function geoSearchCoordinates($latitude, $longitude) {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->location = 'your location';
        $this->ipLatitude = null;
        $this->ipLongitude = null;
        $this->showResults = true;
    }

    public function clearGeoSearch() {
        $this->latitude = null;
        $this->longitude = null;
        $this->location = null;
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
}
