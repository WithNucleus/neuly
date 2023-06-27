<?php

namespace App\Http\Livewire\Public\Entities;

use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Models\Company;
use App\Models\Focus;
use App\Models\Location;
use App\Models\Person;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class PeopleIndex extends Component
{
    use WithPerPagePagination, WithBulkActions, WithCachedRows, WithSorting;

    protected string $paginationTheme = 'bootstrap';
    protected $queryString = ['search', 'sorts'];
    protected $listeners = ['updateSearchLocation'];

    public ?string $search = null;

    public array $filters = [
        'companies' => [],
        'focus' => [],
        'locations' => [],
        'upcoming-events' => false
    ];

    public ?string $locationSearch = null;
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

    // Locations
    public function updatedLocationSearch() {
        if($this->locationSearch) {
            $this->locationSearchResults = Location::whereHas('people')
                ->withCount('people as related_count')
                ->where('name', 'like', '%' . $this->locationSearch . '%')
                ->orderByDesc('related_count')
                ->get()
                ->toArray();
        } else {
            $this->locationSearchResults = Location::whereHas('investors')
                ->withCount('people as related_count')
                ->orderByDesc('related_count')
                ->take(5)
                ->get()
                ->toArray();
        }
    }

    public function setLocationFilter($value) {
        $this->filters['locations'][] = $value;
        $this->reset('locationSearch');
        $this->reset('locationSearchResults');
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
