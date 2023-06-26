<?php

namespace App\Http\Livewire\Public\Entities;

use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Models\Company;
use App\Models\Focus;
use App\Models\Investor;
use App\Models\Location;
use App\Models\Person;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class InvestorsIndex extends Component
{use WithPerPagePagination, WithBulkActions, WithCachedRows, WithSorting;

    protected string $paginationTheme = 'bootstrap';
    protected $queryString = ['search', 'sorts'];
    protected $listeners = ['updateSearchLocation'];

    public ?string $search = null;

    public array $filters = [
        'type' => [],
        'locations' => [],
        'people' => [],
        'companies' => [],
        'now-hiring' => false
    ];

    public ?string $locationSearch = null;
    public array $locationSearchResults = [];
    public ?string $personSearch = null;
    public array $personSearchResults = [];
    public ?string $companySearch = null;
    public array $companySearchResults = [];

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

    // Locations
    public function updatedLocationSearch() {
        if($this->locationSearch) {
            $this->locationSearchResults = Location::whereHas('investors')->where('name', 'like', '%' . $this->locationSearch . '%')->get()->toArray();
        } else {
            $this->locationSearchResults = Location::whereHas('investors')->withCount('investors')->orderByDesc('investors_count')->take(5)->get()->toArray();
        }
    }

    public function setLocationFilter($value) {
        $this->filters['locations'][] = $value;
        $this->reset('locationSearch');
        $this->reset('locationSearchResults');
    }

    // People
    public function updatedPersonSearch() {
        if($this->personSearch) {
            $this->personSearchResults = Person::whereHas('investors')->where('name', 'like', '%' . $this->personSearch . '%')->get()->toArray();
        } else {
            $this->personSearchResults = Person::whereHas('investors')->withCount('investors')->orderByDesc('investors_count')->take(5)->get()->toArray();
        }
    }

    public function setPersonFilter($value) {
        $this->filters['people'][] = $value;
        $this->reset('personSearch');
        $this->reset('personSearchResults');
    }

    // Companies
    public function updatedCompanySearch() {
        if($this->companySearch) {
            $this->companySearchResults = Company::whereHas('investors')->where('name', 'like', '%' . $this->companySearch . '%')->get()->toArray();
        } else {
            $this->companySearchResults = Company::whereHas('investors')->withCount('investors')->orderByDesc('investors_count')->take(5)->get()->toArray();
        }
    }

    public function setCompanyFilter($value) {
        $this->filters['companies'][] = $value;
        $this->reset('companySearch');
        $this->reset('companySearchResults');
    }

    public function getRowsQueryProperty()
    {
        $query = Investor::withCount(['companies', 'jobs' => function (Builder $query) {
                    $query->open();
                }, 'locations'])
                ->when($this->search, function($query, $search) {
                    return $query
                        ->where('name', 'like', '%' . $search . '%')
                        ->orWhereHas('locations', function($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('people', function($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%');
                        });
                })
                ->when($this->filters['type'], function($query, $value) {
                    return $query->where('type', $value);
                })
                ->when($this->filters['locations'], function($query, $valueArray) {
                    return $query->whereHas('locations', function($query) use ($valueArray) {
                        $query->whereIn('name', $valueArray);
                    });
                })
                ->when($this->filters['companies'], function($query, $valueArray) {
                    return $query->whereHas('companies', function($query) use ($valueArray) {
                        $query->whereIn('name', $valueArray);
                    });
                })
                ->when($this->filters['people'], function($query, $valueArray) {
                    return $query->whereHas('people', function($query) use ($valueArray) {
                        $query->whereIn('name', $valueArray);
                    });
                })
                ->when($this->filters['now-hiring'], function($query, $value) {
                    return $query->hasJobs();
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
        return view('livewire.public.entities.investors-index', [
            'records' => $this->rows,
            'typeOptions' => Investor::TYPE,
        ]);
    }
}
