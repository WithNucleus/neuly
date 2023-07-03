<?php

namespace App\Http\Livewire\Public\Entities;

use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\Public\Entities\Traits\HasCompanyFilter;
use App\Http\Livewire\Public\Entities\Traits\HasLocationFilter;
use App\Models\Company;
use App\Models\Focus;
use App\Models\Person;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class PeopleIndex extends Component
{
    use WithPerPagePagination, WithBulkActions, WithCachedRows, WithSorting, HasLocationFilter, HasCompanyFilter;

    protected string $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];

    public ?string $search = null;

    public array $filters = [
        'companies' => [],
        'focus' => [],
        'locations' => [],
        'upcoming-events' => false,
        'has-research' => false,
        'has-clinical-trials' => false
    ];

    public function mount() {
        $this->sorts = [
            'updated_at' => 'desc'
        ];
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

    public function clearFilters() {
        $this->reset('search');
        $this->reset('filters');
        $this->reset('sorts');
        $this->reset('locationSearch');
        $this->reset('locationSearchResults');
        $this->reset('companySearch');
        $this->reset('companySearchResults');
        $this->resetPage();
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

    public function updatedCompanySearch() {
        $this->returnCompanySearch('people');
    }

    public function updatedLocationSearch() {
        $this->returnLocationSearch('people');
    }

    public function getRowsQueryProperty()
    {
        $query = Person::public()
                ->with(['focus'])
                ->withCount(['focus', 'companies', 'locations', 'investors', 'events'])
                ->when($this->search, function($query, $search) {
                    return $query
                        ->where('name', 'like', '%' . $search . '%')
                        ->orWhere('bio', 'like', '%' . $search . '%');
                })
                ->when($this->filters['companies'], function($query, $valueArray) {
                    return $query->whereHas('companies', function($query) use ($valueArray) {
                        $query->whereIn('name', $valueArray);
                    });
                })
                ->when($this->filters['focus'], function($query, $valueArray) {
                    return $query->whereHas('focus', function($query) use ($valueArray) {
                        $query->whereIn('name', $valueArray);
                    });
                })
                ->when($this->filters['locations'], function($query, $valueArray) {
                    return $query->whereHas('locations', function($query) use ($valueArray) {
                        $query->whereIn('name', $valueArray);
                    });
                })
                ->when($this->filters['upcoming-events'], function($query) {
                    return $query->hasUpcomingEvents();
                })
                ->when($this->filters['has-research'], function($query) {
                    return $query->hasResearch();
                })
                ->when($this->filters['has-clinical-trials'], function($query) {
                    return $query->hasClinicalTrials();
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
        $focusOptions = Focus::whereHas('people', function (Builder $query) {
                $query->where('visibility', Person::VISIBILITY_PUBLIC);
            })->withCount(['people' => function (Builder $query) {
                $query->where('visibility', Person::VISIBILITY_PUBLIC);
            }])->orderBy('type')->orderByDesc('people_count')->get()->groupBy('type')->toArray();
        $focusDrugOptions = $focusOptions['drug'];
        $focusOtherOptions = $focusOptions[''];

        return view('livewire.public.entities.people-index', [
            'records' => $this->rows,
            'typeOptions' => Company::OWNERSHIP,
            'focusDrugOptions' => $focusDrugOptions,
            'focusOtherOptions' => $focusOtherOptions
        ]);
    }
}
