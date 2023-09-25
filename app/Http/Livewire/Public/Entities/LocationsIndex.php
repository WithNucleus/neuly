<?php

namespace App\Http\Livewire\Public\Entities;

use App\Http\Livewire\Public\Entities\Traits\HasLocationFilter;
use App\Http\Livewire\Traits\WithBulkActions;
use App\Http\Livewire\Traits\WithCachedRows;
use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\Focus;
use App\Models\Location;
use Livewire\Component;

class LocationsIndex extends Component
{
    use WithPerPagePagination, WithBulkActions, WithCachedRows, WithSorting, HasLocationFilter;

    protected string $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];

    public ?string $search = null;

    public array $filters = [
        'companies' => [],
        'has-companies' => null,
        'has-people' => null,
        'has-investors' => null,
        'has-clinical-trials' => null,
        'has-jobs' => null,
        'has-events' => null,
    ];

    public function mount() {
        $this->sorts = [
            'companies_count' => 'desc'
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

    public function getRowsQueryProperty()
    {
        $query = Location::withCount([
                    'bookableListings',
                    'companies',
                    'people',
                    'investors',
                    'jobs',
                    'events',
                    'clinicaltrials',
                ])
                ->when($this->search, function($query, $search) {
                    return $query
                        ->where('name', 'like', '%' . $search . '%')
                        ->orWhereHas('companies', function($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%');
                        });
                })
                ->when($this->filters['companies'], function($query, $valueArray) {
                    return $query->whereHas('companies', function($query) use ($valueArray) {
                        $query->whereIn('name', $valueArray);
                    });
                })
                ->when($this->filters['has-companies'], function($query) {
                    return $query->whereHas('companies');
                })
                ->when($this->filters['has-people'], function($query) {
                    return $query->whereHas('people');
                })
                ->when($this->filters['has-investors'], function($query) {
                    return $query->whereHas('investors');
                })
                ->when($this->filters['has-clinical-trials'], function($query) {
                    return $query->whereHas('clinicaltrials');
                })
                ->when($this->filters['has-jobs'], function($query) {
                    return $query->whereHas('jobs');
                })
                ->when($this->filters['has-events'], function($query) {
                    return $query->whereHas('events');
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
        return view('livewire.public.entities.locations-index', [
            'records' => $this->rows
        ]);
    }
}
