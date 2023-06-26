<?php

namespace App\Http\Livewire\Public\Entities;

use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Models\Company;
use App\Models\Focus;
use App\Models\Location;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class OrganizationIndex extends Component
{
    /* TODO: Note to self -- use bg-primary-subtle for the breadcrumb bar */
    use WithPerPagePagination, WithBulkActions, WithCachedRows, WithSorting;

    protected string $paginationTheme = 'bootstrap';
    protected $queryString = ['search', 'sorts'];
    protected $listeners = ['updateSearchLocation'];

    public ?string $search = null;

    public array $filters = [
        'type' => [],
        'focus' => [],
        'industry' => [],
        'locations' => [],
        'now-hiring' => false,
        'upcoming-events' => false
    ];

    public string $locationSearch = '';
    public array $locationSearchResults = [];

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

    public function updatedLocationSearch()
    {
        if($this->locationSearch != '') {
            $this->locationSearchResults = Location::where('name', 'like', '%' . $this->locationSearch . '%')->get()->toArray();
        } else {
            $this->locationSearchResults = [];
        }
    }

    public function updateSearchLocation($name) {
        $this->filters['locations'][] = $name;
        $this->reset('locationSearch');
        $this->dispatchBrowserEvent('clearLocationSearchBox');
    }

    public function getRowsQueryProperty()
    {
        $query = Company::with(['focus'])
                ->withCount(['focus', 'events', 'jobs' => function (Builder $query) {
                    $query->open();
                }, 'locations', 'investors'])
                ->when($this->search, function($query, $search) {
                    return $query
                        ->where('name', 'like', '%' . $search . '%')
                        ->orWhere('summary', 'like', '%' . $search . '%')
                        ->orWhereHas('focus', function($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('locations', function($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%');
                        });
                })
                ->when($this->filters['type'], function($query, $value) {
                    return $query->where('ownership', $value);
                })
                ->when($this->filters['focus'], function($query, $value) {
                    return $query->whereHas('focus', function($query) use ($value) {
                        $query->where('name', $value);
                    });
                })
                ->when($this->filters['industry'], function($query, $value) {
                    return $query->whereHas('focus', function($query) use ($value) {
                        $query->where('name', $value);
                    });
                })
                ->when($this->filters['locations'], function($query, $valueArray) {
                    return $query->whereHas('locations', function($query) use ($valueArray) {
                        $query->whereIn('name', $valueArray);
                    });
                })
                ->when($this->filters['now-hiring'], function($query, $value) {
                    return $query->hasJobs();
                })
                ->when($this->filters['upcoming-events'], function($query, $value) {
                    return $query->hasUpcomingEvents();
                });

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->cache(function () {
            return $this->applyPagination($this->rowsQuery);
        });
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $focusOptions = Focus::whereHas('companies')->withCount('companies')->orderBy('type')->orderByDesc('companies_count')->get()->groupBy('type')->toArray();
        $focusDrugOptions = $focusOptions['drug'];
        $focusOtherOptions = $focusOptions[''];

        return view('livewire.public.entities.organization-index', [
            'records' => $this->rows,
            'typeOptions' => Company::OWNERSHIP,
            'focusDrugOptions' => $focusDrugOptions,
            'focusOtherOptions' => $focusOtherOptions
        ]);
    }
}
