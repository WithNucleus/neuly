<?php

namespace App\Http\Livewire\Public\Entities;

use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\Public\Entities\Traits\HasLocationFilter;
use App\Models\Company;
use App\Models\Focus;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class OrganizationIndex extends Component
{
    use WithPerPagePagination, WithBulkActions, WithCachedRows, WithSorting, HasLocationFilter;

    protected string $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];

    public ?string $search = null;

    public array $filters = [
        'type' => [],
        'focus' => [],
        'industry' => [],
        'locations' => [],
        'now-hiring' => false,
        'upcoming-events' => false
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

    public function updatedLocationSearch() {
        $this->returnLocationSearch('companies');
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
                ->when($this->filters['focus'], function($query, $valueArray) {
                    return $query->whereHas('focus', function($query) use ($valueArray) {
                        $query->whereIn('name', $valueArray);
                    });
                })
                ->when($this->filters['industry'], function($query, $valueArray) {
                    return $query->whereHas('focus', function($query) use ($valueArray) {
                        $query->whereIn('name', $valueArray);
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
