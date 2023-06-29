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
use App\Models\Research;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class ResearchIndex extends Component
{
    use WithPerPagePagination, WithBulkActions, WithCachedRows, WithSorting;

    protected string $paginationTheme = 'bootstrap';
    protected $queryString = ['search', 'sorts'];
    protected $listeners = ['updateSearchLocation'];

    public ?string $search = null;

    public array $filters = [
        'focus' => [],
        'people' => [],
        'companies' => []
    ];

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

    // People
    public function updatedPersonSearch() {
        if($this->personSearch) {
            $this->personSearchResults = Person::whereHas('research')
                ->withCount('research as related_count')
                ->where('name', 'like', '%' . $this->personSearch . '%')
                ->orderByDesc('related_count')
                ->get()
                ->toArray();
        } else {
            $this->personSearchResults = Person::whereHas('research')
                ->withCount('research as related_count')
                ->orderByDesc('related_count')
                ->take(5)
                ->get()
                ->toArray();
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
            $this->companySearchResults = Company::whereHas('research')
                ->withCount('research as related_count')
                ->where('name', 'like', '%' . $this->companySearch . '%')
                ->orderByDesc('related_count')
                ->get()
                ->toArray();
        } else {
            $this->companySearchResults = Company::whereHas('research')
                ->withCount('research as related_count')
                ->orderByDesc('related_count')
                ->take(5)
                ->get()
                ->toArray();
        }
    }

    public function setCompanyFilter($value) {
        $this->filters['companies'][] = $value;
        $this->reset('companySearch');
        $this->reset('companySearchResults');
    }

    public function getRowsQueryProperty()
    {
        $query = Research::with(['focus', 'companies', 'people'])
                ->withCount(['focus', 'companies', 'people'])
                ->when($this->search, function($query, $search) {
                    return $query
                        ->where('name', 'like', '%' . $search . '%')
                        ->orWhere('abstract', 'like', '%' . $search . '%')
                        ->orWhere('publication_info', 'like', '%' . $search . '%');
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
        return view('livewire.public.entities.research-index', [
            'records' => $this->rows,
            'focusDrugOptions' => Focus::whereHas('research')->withCount('research')->orderByDesc('research_count')->get()->toArray()
        ]);
    }
}
