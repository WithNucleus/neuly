<?php

namespace App\Http\Livewire\Public\Entities;

use App\Http\Livewire\Traits\WithBulkActions;
use App\Http\Livewire\Traits\WithCachedRows;
use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Http\Livewire\Public\Entities\Traits\HasLocationFilter;
use App\Models\Company;
use App\Models\Focus;
use App\Models\Job;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class JobsIndex extends Component
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
        $this->returnLocationSearch('jobs');
    }

    public function getRowsQueryProperty()
    {
        $query = Job::with(['focus', 'owner'])
                ->withCount(['focus'])
                ->when($this->search, function($query, $search) {
                    return $query
                        ->where('job_title', 'like', '%' . $search . '%')
                        ->orWhere('job_description', 'like', '%' . $search . '%')
                        ->orWhereHas('focus', function($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('locations', function($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%');
                        });
                })
                ->when($this->filters['type'], function($query, $value) {
                    return $query->where('employment_type', $value);
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
        $focusOptions = Focus::whereHas('jobs')->withCount('jobs')->orderBy('type')->orderByDesc('jobs_count')->get()->groupBy('type')->toArray();
        $focusDrugOptions = $focusOptions['drug'];
        $focusOtherOptions = $focusOptions[''];
        $focusOtherOptions = array_slice($focusOtherOptions, 0, 10);

        return view('livewire.public.entities.jobs-index', [
            'records' => $this->rows,
            'typeOptions' => Job::EMPLOYMENT_TYPE,
            'focusDrugOptions' => $focusDrugOptions,
            'focusOtherOptions' => $focusOtherOptions
        ]);
    }
}
