<?php

namespace App\Http\Livewire\Public\Featured;

use App\Http\Livewire\Traits\WithBulkActions;
use App\Http\Livewire\Traits\WithCachedRows;
use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\Focus;
use App\Models\Report;
use Livewire\Component;

class IndustryReports extends Component
{
    use WithPerPagePagination, WithBulkActions, WithCachedRows, WithSorting;

    protected string $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];

    public ?string $search = null;

    public array $filters = [
        'focus' => [],
    ];

    public function mount() {
        $this->sorts = [
            'date' => 'desc'
        ];

        $this->perPage = 12;
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
        $query = Report::published()->with(['focus'])
            ->when($this->search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    return $query
                        ->where('name', 'like', '%' . $search . '%')
                        ->orWhere('excerpt', 'like', '%' . $search . '%');
                });
            })->when($this->filters['focus'], function ($query, $valueArray) {
                return $query->whereHas('focus', function ($query) use ($valueArray) {
                    $query->whereIn('name', $valueArray);
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
        return view('livewire.public.featured.industry-reports', [
            'records' => $this->rows,
            'focusOptions' => Focus::whereHas('reports')->withCount('reports')->orderByDesc('reports_count')->get()->toArray()
        ]);
    }
}
