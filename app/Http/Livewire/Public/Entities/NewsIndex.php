<?php

namespace App\Http\Livewire\Public\Entities;

use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\Public\Entities\Traits\HasCompanyFilter;
use App\Http\Livewire\Public\Entities\Traits\HasPersonFilter;
use App\Models\Focus;
use App\Models\MediaItem;
use Livewire\Component;

class NewsIndex extends Component
{
    use WithPerPagePagination, WithBulkActions, WithCachedRows, WithSorting, HasCompanyFilter, HasPersonFilter;

    protected string $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];

    public ?string $search = null;

    public array $filters = [
        'focus' => [],
        'people' => [],
        'companies' => [],
    ];

    public function mount() {
        $this->sorts = [
            'date' => 'desc'
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
        $this->reset('personSearch');
        $this->reset('personSearchResults');
        $this->reset('companySearch');
        $this->reset('companySearchResults');
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

    public function updatedCompanySearch() {
        $this->returnCompanySearch('news');
    }

    public function updatedPersonSearch() {
        $this->returnPersonSearch('news');
    }

    public function getRowsQueryProperty()
    {
        $query = MediaItem::news()->with(['companies', 'people', 'focus', 'source'])
                ->when($this->search, function($query, $search) {
                    return $query->news()->where(function ($query) use ($search) {
                        return $query
                            ->where('name', 'like', '%' . $search . '%')
                            ->orWhere('summary', 'like', '%' . $search . '%')
                            ->orWhere('content', 'like', '%' . $search . '%');
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
        return view('livewire.public.entities.news-index', [
            'records' => $this->rows,
            'focusOptions' => Focus::whereHas('news')->withCount('news')->orderByDesc('news_count')->get()->toArray()
        ]);
    }
}
