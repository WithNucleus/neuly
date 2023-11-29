<?php

namespace App\Http\Livewire\Public\Entities;

use App\Http\Livewire\Public\Entities\Traits\HasLocationFilterWithQuery;
use App\Http\Livewire\Traits\WithBulkActions;
use App\Http\Livewire\Traits\WithCachedRows;
use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\Company;
use App\Models\EmploymentType;
use App\Models\Focus;
use App\Models\Investor;
use App\Models\Job;
use Livewire\Component;

class JobsIndex extends Component
{
    use WithPerPagePagination, WithBulkActions, WithCachedRows, WithSorting, HasLocationFilterWithQuery;

    protected string $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];

    public ?string $search = null;

    public array $filters = [
        'type' => [],
        'focus' => [],
        'industry' => [],
        'locations' => [],
        'owners' => [],
        'remote' => false,
        'status' => Job::STATUS_OPEN
    ];

    public array $typeOptions = [];
    public array $focusDrugOptions = [];
    public array $focusOtherOptions = [];

    public ?string $ownerSearch = null;
    public array $ownerSearchResults = [];

    public function mount() {
        $this->sorts = [
            'posted_date' => 'desc'
        ];

        $this->setCheckboxes();
    }

    private function setCheckboxes() {
        $focusOptions = Focus::whereRelation('jobs', 'status', $this->filters['status'])
            ->withCount(["jobs" => function($query) {
                $query->where('status', $this->filters['status']);
            }])
            ->orderBy('type')
            ->orderByDesc('jobs_count')
            ->get()
            ->groupBy('type')
            ->toArray();

        $focusDrugOptions = $focusOptions['drug'];
        $focusOtherOptions = $focusOptions[''];
        $focusOtherOptions = array_slice($focusOtherOptions, 0, 10);

        $this->focusDrugOptions = $focusDrugOptions;
        $this->focusOtherOptions = $focusOtherOptions;

        $this->typeOptions = EmploymentType::whereRelation('jobs', 'status', $this->filters['status'])
            ->withCount(["jobs" => function($query) {
                $query->where('status', $this->filters['status']);
            }])
            ->get()
            ->toArray();
    }

    public function updatedFiltersStatus() {
        $this->setCheckboxes();
    }

    public function returnOwnerSearch() {
        if($this->ownerSearch) {
            $companies = Company::whereRelation('jobs', 'status', $this->filters['status'])
                ->withCount(["jobs AS related_count" => function($query) {
                    $query->where('status', $this->filters['status']);
                }])
                ->where('name', 'like', '%' . $this->ownerSearch . '%')
                ->orderByDesc('related_count')
                ->get()
                ->toArray();
            $investors = Investor::whereRelation('jobs', 'status', $this->filters['status'])
                ->withCount(["jobs AS related_count" => function($query) {
                    $query->where('status', $this->filters['status']);
                }])
                ->where('name', 'like', '%' . $this->ownerSearch . '%')
                ->orderByDesc('related_count')
                ->get()
                ->toArray();

            $this->ownerSearchResults = array_merge($companies, $investors);
        } else {
            $this->ownerSearchResults = Company::whereRelation('jobs', 'status', $this->filters['status'])
                ->withCount(["jobs AS related_count" => function($query) {
                    $query->where('status', $this->filters['status']);
                }])
                ->orderByDesc('related_count')
                ->take(5)
                ->get()
                ->toArray();
        }
    }

    public function setOwnerFilter($value) {
        $this->filters['owners'][] = $value;
        $this->reset('ownerSearch');
        $this->reset('ownerSearchResults');
    }

    public function updatedOwnerSearch() {
        $this->returnOwnerSearch();
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
        $this->reset('locationSearch');
        $this->reset('locationSearchResults');
        $this->sorts = [
            'posted_date' => 'desc'
        ];
        $this->resetPage();
        $this->setCheckboxes();
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
                ->when($this->filters['owners'], function($query, $valueArray) {
                    return $query->whereHas('owner', function($query) use ($valueArray) {
                        $query->whereIn('name', $valueArray);
                    });
                })
                ->when($this->filters['remote'], function($query) {
                    return $query->whereHas('locations', function($query) {
                        $query->whereIn('name', ['Remote', 'Virtual']);
                    });
                })
                ->when($this->filters['status'], function($query, $value) {
                    return $query->where('status', $value);
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
        return view('livewire.public.entities.jobs-index', [
            'records' => $this->rows,
            'statusOptions' => Job::STATUS_VALUES
        ]);
    }
}
