<?php

namespace App\Http\Livewire\Public\Featured;

use App\Http\Livewire\Public\Entities\Traits\ClinicalTrialFilters;
use App\Http\Livewire\Public\Traits\LocalLocationFilter;
use App\Http\Livewire\Traits\WithBulkActions;
use App\Http\Livewire\Traits\WithCachedRows;
use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\Clinicaltrial;
use App\Models\ClinicalTrialDetails\CtCondition;
use App\Models\Focus;
use App\Models\SearchLog;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Spatie\SlackAlerts\Facades\SlackAlert;

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
    public $conditions = [];
    public $treatments = [];

    public bool $showClinicalTrials = false;

    public ?string $showTrialsError = null;

    public $search;

    public array $filters = [
        'focus' => [],
        'locations' => [],
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

//         $this->ip = $request->getClientIp(); // PRODUCTION
        // TODO: DO NOT LEAVE THIS FOR PRODUCTION
         $this->ip = "108.92.170.181"; // Sydney

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

        SlackAlert::to('dev')->message("**Recruiting Trials Concierge Request**" . "\n" . 'Name: ' . $this->name . "\n" . "Email: " . $this->email);

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

        if ($this->age OR $this->sex OR $this->treatments OR $this->healthy) {
            $this->reset('showTrialsError');
        } else {
            $this->showTrialsError = "Please enter some criteria to show results";
            return;
        }

        if($this->healthy === Clinicaltrial::HEALTHY_YES) {
            $this->filters['healthy_volunteers'] = 1;
            $this->reset('conditions');
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
        $query = Clinicaltrial::with(['focus', 'companies', 'people', 'locations', 'conditions', 'interventions', 'phases'])
            ->withCount(['focus', 'companies', 'people'])
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
            ->when($this->filters['locations'], function($query, $value) {
                return $query->whereHas('locations', function($query) use ($value) {
                    $query->whereIn('name', $value);
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
