<?php

namespace App\Http\Livewire\Public\Entities;

use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\Public\Entities\Traits\HasCompanyFilter;
use App\Models\Course;
use App\Models\Focus;
use Livewire\Component;

class CoursesIndex extends Component
{
    use WithPerPagePagination, WithBulkActions, WithCachedRows, WithSorting, HasCompanyFilter;

    protected string $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];

    public ?string $search = null;

    public array $filters = [
        'focus' => [],
        'companies' => [],
        'education' => [],
        'type' => [],
        'education-credits' => null,
        'free' => null
    ];

    public function mount() {
        $this->sorts = [
            'lowest_cost' => 'asc'
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
        $this->reset('companySearch');
        $this->reset('companySearchResults');
        $this->resetPage();

        $this->sorts = [
            'lowest_cost' => 'asc'
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
        $this->returnCompanySearch('courses');
    }

    public function getRowsQueryProperty()
    {
        $query = Course::with(['companies', 'focus'])
                ->when($this->search, function($query, $search) {
                    return $query->books()->where(function ($query) use ($search) {
                        return $query
                            ->where('name', 'like', '%' . $search . '%')
                            ->orWhere('summary', 'like', '%' . $search . '%')
                            ->orWhere('schedule', 'like', '%' . $search . '%')
                            ->orWhere('type', 'like', '%' . $search . '%')
                            ->orWhere('education_credits', 'like', '%' . $search . '%')
                            ->orwhereHas('focus', function($query) use ($search) {
                                $query->where('name', 'like', '%' . $search . '%');
                            });
                   });
                })
                ->when($this->filters['type'], function($query, $valueArray) {
                    return $query->whereIn('type', $valueArray);
                })
                ->when($this->filters['education'], function($query, $valueArray) {
                    $query->whereIn('education_credits', $valueArray);
                })
                ->when($this->filters['focus'], function($query, $valueArray) {
                    return $query->whereHas('focus', function($query) use ($valueArray) {
                        $query->whereIn('name', $valueArray);
                    });
                })
                ->when($this->filters['companies'], function($query, $valueArray) {
                    return $query->whereHas('companies', function($query) use ($valueArray) {
                        $query->whereIn('name', $valueArray);
                    });
                })
                ->when($this->filters['education-credits'], function($query) {
                    return $query->whereNotNull('education_credits');
                })
                ->when($this->filters['free'], function($query) {
                    return $query->where('lowest_cost', 0);
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
        return view('livewire.public.entities.courses-index', [
            'records' => $this->rows,
            'focusOptions' => Focus::whereHas('courses')->withCount('courses')->orderByDesc('courses_count')->get()->toArray(),
            'typeOptions' => Course::TYPES,
            'educationOptions' => Course::whereNotNull('education_credits')->pluck('education_credits')->unique()->sort()->toArray()
        ]);
    }
}
