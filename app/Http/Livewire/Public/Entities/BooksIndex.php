<?php

namespace App\Http\Livewire\Public\Entities;

use App\Http\Livewire\Traits\WithBulkActions;
use App\Http\Livewire\Traits\WithCachedRows;
use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\Focus;
use App\Models\MediaItem;
use Livewire\Component;

class BooksIndex extends Component
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
        $query = MediaItem::books()->with(['companies', 'people', 'focus', 'source'])
                ->when($this->search, function($query, $search) {
                    return $query->books()->where(function ($query) use ($search) {
                        return $query
                            ->where('name', 'like', '%' . $search . '%')
                            ->orWhere('summary', 'like', '%' . $search . '%')
                            ->orWhere('content', 'like', '%' . $search . '%')
                            ->orwhereHas('focus', function($query) use ($search) {
                                $query->where('name', 'like', '%' . $search . '%');
                            });
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
        return view('livewire.public.entities.books-index', [
            'records' => $this->rows,
            'focusOptions' => Focus::whereHas('books')->withCount('books')->orderByDesc('books_count')->get()->toArray()
        ]);
    }
}
