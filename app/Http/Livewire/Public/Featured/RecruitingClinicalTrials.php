<?php

namespace App\Http\Livewire\Public\Featured;

use App\Http\Livewire\Public\Traits\LocalLocationFilter;
use App\Http\Livewire\Traits\WithBulkActions;
use App\Http\Livewire\Traits\WithCachedRows;
use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\Clinicaltrial;
use App\Models\Focus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class RecruitingClinicalTrials extends Component
{
    use WithPerPagePagination, WithBulkActions, WithCachedRows, WithSorting, LocalLocationFilter;

    protected string $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];

    public ?string $search = null;

    public array $filters = [
        'focus' => [],
        'gender' => []
    ];

    public string $ip;
    public ?int $userId = null;

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
        $this->ip = $request->getClientIp(); // PRODUCTION
        // $this->ip = "108.92.170.181"; // Sydney

        $this->getLocalLocation();

        $this->sorts = [
            'updated_at' => 'desc'
        ];

        if (Auth::id()) {
            $this->userId = Auth::id();
        }
    }

    public function getRowsQueryProperty()
    {
        $query = Clinicaltrial::recruiting()->with([
                    'focus',
                    'locations',
                    'companies',
                    'people',
                    'conditions',
                    'interventions'
                ])
                ->when($this->search, function($query, $search) {
                    return $query->public()->where(function ($query) use ($search) {
                        return $query
                            ->where('title', 'like', '%' . $search . '%')
                            ->orWhere('nct_number', 'like', '%' . $search . '%')
                            ->orwhereHas('focus', function($query) use ($search) {
                                $query->where('name', 'like', '%' . $search . '%');
                            })
                            ->orwhereHas('companies', function($query) use ($search) {
                                $query->where('name', 'like', '%' . $search . '%');
                            })
                            ->orwhereHas('people', function($query) use ($search) {
                                $query->where('name', 'like', '%' . $search . '%');
                            })
                            ->orwhereHas('location', function($query) use ($search) {
                                $query->where('name', 'like', '%' . $search . '%');
                            });
                   });
                })
                ->when($this->filters['gender'], function($query, $valueArray) {
                    return $query->whereIn('gender', $valueArray);
                })
                ->when($this->filters['focus'], function($query, $valueArray) {
                    return $query->whereHas('focus', function($query) use ($valueArray) {
                        $query->whereIn('name', $valueArray);
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
        return view('livewire.public.featured.recruiting-clinical-trials',[
            'records' => $this->rows,
            'focusOptions' => Focus::drugs()->whereHas('recruitingClinicalTrials')->withCount('recruitingClinicalTrials')->orderByDesc('recruiting_clinical_trials_count')->get()->toArray(),
            'genderOptions' => DB::table('clinicaltrials')
                ->whereNotNull('gender')
                ->select(DB::raw('count(*) as count, gender'))
                ->groupBy('gender')
                ->get()
                ->toArray()
        ]);
    }
}
