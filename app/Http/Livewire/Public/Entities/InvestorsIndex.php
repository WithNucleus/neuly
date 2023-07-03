<?php

namespace App\Http\Livewire\Public\Entities;

use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\Public\Entities\Traits\HasCompanyFilter;
use App\Http\Livewire\Public\Entities\Traits\HasLocationFilter;
use App\Http\Livewire\Public\Entities\Traits\HasPersonFilter;
use App\Models\Investor;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class InvestorsIndex extends Component
{use WithPerPagePagination, WithBulkActions, WithCachedRows, WithSorting, HasCompanyFilter, HasLocationFilter, HasPersonFilter;

    protected string $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];

    public ?string $search = null;

    public array $filters = [
        'type' => [],
        'locations' => [],
        'people' => [],
        'companies' => [],
        'now-hiring' => false
    ];

    public function mount() {
        $this->sorts = [
            'name' => 'asc'
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
        $this->returnCompanySearch('investors');
    }

    public function updatedPersonSearch() {
        $this->returnPersonSearch('investors');
    }

    public function updatedLocationSearch() {
        $this->returnLocationSearch('investors');
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
