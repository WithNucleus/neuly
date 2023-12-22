<?php

namespace App\Http\Livewire\Public\Featured;

use App\Http\Livewire\Public\Entities\Traits\ClinicalTrialFilters;
use App\Http\Livewire\Public\Traits\LocalLocationFilter;
use App\Http\Livewire\Traits\WithBulkActions;
use App\Http\Livewire\Traits\WithCachedRows;
use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\BookableListing;
use App\Models\CareRequest;
use App\Models\Clinicaltrial;
use App\Models\ClinicalTrialDetails\CtCondition;
use App\Models\Focus;
use App\Models\SearchLog;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Spatie\SlackAlerts\Facades\SlackAlert;
use Throwable;

class RecruitingTrials extends Component
{
    use WithPerPagePagination, WithBulkActions, WithCachedRows, WithSorting, LocalLocationFilter, ClinicalTrialFilters;

    protected string $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];

    public string $ip;
    public ?int $userId = null;

    // form fields
    public $age;
    public $sex;
    public $healthy;
    public $location_search;
    public $conditions = [];
    public $treatments = [];

    public $locationResult = [
        'city' => null,
        'state' => null,
        'latitude' => null,
        'longitude' => null
    ];

    public bool $showClinicalTrials = false;

    public ?string $showTrialsError = null;

    public $search;

    public array $filters = [
        'focus' => [],
        'location' => null,
        'conditions' => [],
        'min_age' => null,
        'max_age' => null,
        'sex' => null,
        'healthy_volunteers' => null
    ];

    public ?string $name = null;
    public ?string $email = null;
    public ?string $message = null;
    public ?string $conciergeSuccess = null;

    public array $localLocation = [
        'latitude' => null,
        'longitude' => null,
        'name' => null,
        'id' => null
    ];

    public function mount(Request $request) {

         $this->ip = $request->getClientIp(); // PRODUCTION

        $this->getLocalLocation();

        if (Auth::id()) {
            $user = User::findOrFail(Auth::id());
            $this->userId = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
        }

        $this->perPage = 10;
    }

    public function rules() {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'nullable',
        ];
    }

    public function submit() {
        $this->validate();

        CareRequest::create([
            'name' => $this->name,
            'email' => $this->email,
            'type' => CareRequest::TYPE_CLINICAL_TRIAL_PARTICIPANT,
            'status' => CareRequest::STATUS_OPEN,
            'message' => $this->message,
            'data' => [
                'filters' => $this->filters,
                'age' => $this->age,
                'sex' => $this->sex,
                'healthy' => $this->healthy,
                'conditions' => $this->conditions,
                'treatments' => $this->treatments,
            ],
            'user_id' => $this->userId,
            'ip' => $this->ip,
        ]);

        SearchLog::create([
            'term' => $this->search ?? 'empty',
            'type' => SearchLog::TYPE_RECRUITING_CONCIERGE,
            'ip' => $this->ip,
            'data' => [
                'filters' => $this->filters,
                'name' => $this->name,
                'email' => $this->email,
                'message' => $this->message
            ],
            'user_id' => $this->userId,
        ]);

        $this->conciergeSuccess = "Great! We've received your info and will be in touch soon.";
    }

    public function goListing($id) {
        $clinicalTrial = Clinicaltrial::find($id);

        SearchLog::create([
            'term' => $this->search ?? 'empty',
            'type' => SearchLog::TYPE_RECRUITING_TRIALS,
            'ip' => $this->ip,
            'data' => [
                'filters' => $this->filters,
                'locations' => [
                    'local' => $this->localLocation,
                ]
            ],
            'relatable_type' => Clinicaltrial::class,
            'relatable_id' => $clinicalTrial->id,
            'user_id' => $this->userId
        ]);

        $this->dispatchBrowserEvent('go-to-listing', ['url' => route('discover.clinicaltrials.show', $clinicalTrial->slug)]);
    }

    public function updatingSearch() {
        $this->resetPage();
    }

    public function updatingFilters() {
        $this->resetPage();
    }

    public function gotoPage($page)
    {
        $this->setPage($page);
        $this->dispatchBrowserEvent('scroll-to-trials');
    }

    public function nextPage()
    {
        $this->setPage($this->page + 1);
        $this->dispatchBrowserEvent('scroll-to-trials');
    }

    public function previousPage()
    {
        $this->setPage(max($this->page - 1, 1));
        $this->dispatchBrowserEvent('scroll-to-trials');
    }

    public function updatedConditionSearch() {
        $this->returnConditionSearch();
    }

    public function assignCondition($id) {
        $condition = CtCondition::findOrFail($id);
        $this->conditions[$condition->id] = $condition->value;
        $this->reset('conditionSearch');
        $this->reset('conditionSearchResults');
    }

    public function removeCondition($id) {
        unset($this->conditions[$id]);
    }

    public function addTreatment($id) {
        $focus = Focus::findOrFail($id);
        $this->treatments[$focus->id] = $focus->name;
    }

    public function removeTreatment($id) {
        unset($this->treatments[$id]);
    }

    public function showTrials() {

        if ($this->age OR $this->sex OR $this->treatments OR $this->healthy OR $this->location_search) {
            $this->reset('showTrialsError');
        } else {
            $this->showTrialsError = "Please enter some criteria to show results";
            return;
        }

        if($this->healthy === Clinicaltrial::HEALTHY_YES) {
            $this->filters['healthy_volunteers'] = 1;
            $this->reset('conditions');
        }

        if ($this->location_search) {
            $url = "https://api.geoapify.com/v1/geocode/autocomplete?text={$this->location_search}&type=locality&apiKey=" . config('services.geoapify.key');

            try {
                $request = Http::get($url);
                $response = json_decode($request->body(), true);

                if (array_key_exists('features', $response)) {

                    $firstLocation = $response['features'][0];
                    $this->locationResult['city'] = $firstLocation['properties']['city'] ?? $firstLocation['properties']['suburb'] ?? NULL;
                    $this->locationResult['state'] = $firstLocation['properties']['state'] ?? NULL;
                    $this->locationResult['longitude'] = $firstLocation['properties']['lon'];
                    $this->locationResult['latitude'] = $firstLocation['properties']['lat'];

                    if ($this->locationResult['city']) {
                        $this->filters['location'] = $this->locationResult['city'];
                    } elseif($this->locationResult['state']) {
                        $this->filters['location'] = $this->locationResult['state'];
                    } else {
                        $this->filters['location'] = null;
                    }

                }

            } catch(Throwable $exception) {
                $message = 'Problem during Recruiting Trials location geocoding ' . $exception->getMessage();
                SlackAlert::to('dev')->message($message);
                Log::warning($message);

                $this->filters['location'] = null;
            }
        }

        $this->filters['min_age'] = $this->age;
        $this->filters['max_age'] = $this->age;
        $this->filters['focus'] = $this->treatments;
        $this->filters['conditions'] = $this->conditions;

        if ($this->sex === Clinicaltrial::SEX_FEMALE OR Clinicaltrial::SEX_MALE) {
            $this->filters['sex'] = $this->sex;
        } else {
            $this->filters['sex'] = Clinicaltrial::SEX_ALL;
        }

        SearchLog::create([
            'term' => $this->search ?? 'empty',
            'type' => SearchLog::TYPE_RECRUITING_TRIALS_ELIGIBILITY,
            'ip' => $this->ip,
            'data' => [
                'filters' => $this->filters
            ],
            'user_id' => $this->userId
        ]);

        $this->showClinicalTrials = true;
        $this->resetPage();
        $this->dispatchBrowserEvent('scroll-to-trials');
    }

    public function getRowsQueryProperty()
    {
        $query = Clinicaltrial::recruiting()
            ->with(['focus', 'companies', 'people', 'locations', 'conditions', 'interventions', 'phases'])
            ->withCount(['focus', 'companies', 'people', 'locations', 'conditions'])
            ->when($this->search, function($query, $search) {
                return $query
                    ->where('title', 'like', '%' . $search . '%')
                    ->orWhere('nct_number', 'like', '%' . $search . '%');
            })
            ->when($this->filters['focus'], function($query, $value) {
                return $query->whereHas('focus', function($query) use ($value) {
                    $query->whereIn('name', $value);
                });
            })
            ->when($this->filters['location'], function($query, $value) {
                return $query->whereHas('locations', function($query) use ($value) {
                    $query->where('name', 'like', '%' . $value . '%');
                });
            })
            ->when($this->filters['conditions'], function($query, $value) {
                return $query->whereHas('conditions', function($query) use ($value) {
                    $query->whereIn('value', $value);
                });
            })
            ->when($this->filters['min_age'], function($query, $value) {
                return $query->where('min_age', '<', $value);
            })
            ->when($this->filters['max_age'], function($query, $value) {
                return $query->where('max_age', '>', $value);
            })
            ->when($this->filters['healthy_volunteers'], function($query, $value) {
                return $query->where('healthy_volunteers', $value);
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
        return view('livewire.public.featured.recruiting-trials', [
            'records' => $this->rows,
            'sexOptions' => Clinicaltrial::SEX_OPTIONS,
            'focusOptions' => Focus::orderBy('name')->whereHas('clinicaltrials')->get()->toArray()
        ]);
    }
}
