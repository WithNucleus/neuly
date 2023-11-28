<?php

namespace App\Http\Livewire\Public\Entities;

use App\Http\Livewire\Traits\WithBulkActions;
use App\Http\Livewire\Traits\WithCachedRows;
use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Http\Livewire\Public\Entities\Traits\HasCompanyFilterWithQuery;
use App\Http\Livewire\Public\Entities\Traits\HasPersonFilterWithQuery;
use App\Http\Livewire\Public\Entities\Traits\HasLocationFilterWithQuery;
use App\Models\Event;
use App\Models\EventType;
use App\Models\Focus;
use Carbon\Carbon;
use Livewire\Component;

class EventsIndex extends Component
{
    use WithPerPagePagination, WithBulkActions, WithCachedRows, WithSorting, HasCompanyFilterWithQuery, HasLocationFilterWithQuery, HasPersonFilterWithQuery;

    protected string $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];

    public ?string $search = null;

    public array $filters = [
        'type' => [],
        'focus' => [],
        'industry' => [],
        'locations' => [],
        'people' => [],
        'companies' => [],
        'upcoming' => false,
        'start_date' => null,
        'end_date' => null
    ];

    public array $typeOptions = [];
    public array $focusDrugOptions = [];
    public array $focusOtherOptions = [];

    public function mount() {
        $this->sorts = [
            'start_date' => 'asc'
        ];

        $this->setStartDate();
        $this->setCheckboxes();
    }

    private function setCheckboxes() {
        $focusOptions = Focus::whereRelation('events', 'start_date', '>=', $this->filters['start_date'])
            ->withCount(["events" => function($query) {
                $query->where('start_date', '>=', $this->filters['start_date']);
            }])
            ->orderBy('type')
            ->orderByDesc('events_count')
            ->get()
            ->groupBy('type')
            ->toArray();

        $focusDrugOptions = $focusOptions['drug'];
        $focusOtherOptions = $focusOptions[''];
        $focusOtherOptions = array_slice($focusOtherOptions, 0, 10);

        $this->focusDrugOptions = $focusDrugOptions;
        $this->focusOtherOptions = $focusOtherOptions;

        $this->typeOptions = EventType::whereRelation('events', 'start_date', '>=', $this->filters['start_date'])
            ->withCount(["events" => function($query) {
                $query->where('start_date', '>=', $this->filters['start_date']);
            }])
            ->get()
            ->toArray();
    }

    private function setStartDate() {
        $this->filters['start_date'] = Carbon::now()->format('Y-m-d');
    }

    public function updatingSearch() {
        $this->resetPage();
    }

    public function updatingFilters() {
        $this->resetPage();
    }

    public function updatedFiltersStartDate() {
        $this->setCheckboxes();
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
        $this->setStartDate();
        $this->setCheckboxes();

        $this->sorts = [
            'start_date' => 'asc'
        ];
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
        $this->returnCompanySearch('events', 'start_date', '>=', $this->filters['start_date']);
    }

    public function updatedPersonSearch() {
        $this->returnPersonSearch('events', 'start_date', '>=', $this->filters['start_date']);
    }

    public function updatedLocationSearch() {
        $this->returnLocationSearch('events', 'start_date', '>=', $this->filters['start_date']);
    }

    public function getRowsQueryProperty()
    {
        $query = Event::withCount(['companies', 'locations', 'people', 'eventTypes'])
                ->when($this->filters['upcoming'], function($query) {
                    $query->upcoming();
                })
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
                ->when($this->filters['type'], function($query, $valueArray) {
                    return $query->whereHas('eventTypes', function($query) use ($valueArray) {
                        $query->whereIn('name', $valueArray);
                    });
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
                ->when($this->filters['start_date'], function($query, $value) {
                    return $query->whereHas('focus', function($query) use ($value) {
                        $query->where('start_date', '>=', $value);
                    });
                })
                ->when($this->filters['end_date'], function($query, $value) {
                    return $query->whereHas('focus', function($query) use ($value) {
                        $query->where('end_date', '<=', $value);
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
        return view('livewire.public.entities.events-index', [
            'records' => $this->rows
        ]);
    }
}
