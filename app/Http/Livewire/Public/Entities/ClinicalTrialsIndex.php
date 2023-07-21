<?php

namespace App\Http\Livewire\Public\Entities;

use App\Http\Livewire\Traits\WithBulkActions;
use App\Http\Livewire\Traits\WithCachedRows;
use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Http\Livewire\Public\Entities\Traits\ClinicalTrialFilters;
use App\Http\Livewire\Public\Entities\Traits\HasCompanyFilter;
use App\Http\Livewire\Public\Entities\Traits\HasLocationFilter;
use App\Http\Livewire\Public\Entities\Traits\HasPersonFilter;
use App\Models\Clinicaltrial;
use App\Models\Focus;
use Livewire\Component;

class ClinicalTrialsIndex extends Component
{
    use WithPerPagePagination, WithBulkActions, WithCachedRows, WithSorting, HasLocationFilter, HasCompanyFilter, HasPersonFilter, ClinicalTrialFilters;

    protected string $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];

    public ?string $search = null;

    public array $filters = [
        'focus' => [],
        'people' => [],
        'companies' => [],
        'locations' => [],
        'conditions' => []
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
        $this->reset('personSearch');
        $this->reset('personSearchResults');
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
        $this->returnCompanySearch('clinicaltrials');
    }

    public function updatedPersonSearch() {
        $this->returnPersonSearch('clinicaltrials');
    }

    public function updatedLocationSearch() {
        $this->returnLocationSearch('clinicaltrials');
    }

    public function updatedConditionSearch() {
        $this->returnConditionSearch();
    }

    public function getRowsQueryProperty()
    {
        $query = Clinicaltrial::with(['focus', 'companies', 'people', 'locations', 'conditions'])
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
                ->when($this->filters['people'], function($query, $value) {
                    return $query->whereHas('people', function($query) use ($value) {
                        $query->whereIn('name', $value);
                    });
                })
                ->when($this->filters['companies'], function($query, $value) {
                    return $query->whereHas('companies', function($query) use ($value) {
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
        return view('livewire.public.entities.clinical-trials-index', [
            'records' => $this->rows,
            'focusDrugOptions' => Focus::whereHas('clinicaltrials')->withCount('clinicaltrials')->orderByDesc('clinicaltrials_count')->get()->toArray()
        ]);
    }
}
