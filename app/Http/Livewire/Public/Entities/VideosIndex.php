<?php

namespace App\Http\Livewire\Public\Entities;

use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Models\Focus;
use App\Models\MediaItem;
use Livewire\Component;

class VideosIndex extends Component
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
        $this->resetPage();

        $this->sorts = [
            'date' => 'desc'
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

    public function getRowsQueryProperty()
    {
        $query = MediaItem::videos()->with(['companies', 'people', 'focus', 'source'])
                ->when($this->search, function($query, $search) {
                    return $query->videos()->where(function ($query) use ($search) {
                        return $query
                            ->where('name', 'like', '%' . $search . '%')
                            ->orWhere('summary', 'like', '%' . $search . '%')
                            ->orWhere('content', 'like', '%' . $search . '%');
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
        return view('livewire.public.entities.videos-index', [
            'records' => $this->rows,
            'focusOptions' => Focus::whereHas('videos')->withCount('videos')->orderByDesc('videos_count')->get()->toArray()
        ]);
    }
}
