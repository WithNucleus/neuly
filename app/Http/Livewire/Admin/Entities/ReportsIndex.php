<?php

namespace App\Http\Livewire\Admin\Entities;

use App\Http\Livewire\Traits\WithBulkActions;
use App\Http\Livewire\Traits\WithCachedRows;
use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Jobs\AutoTag\TagClinicalTrial;
use App\Jobs\AutoTag\TagReport;
use App\Jobs\Reports\GetWordPressPosts;
use App\Models\Focus;
use App\Models\Report;
use Livewire\Component;

class ReportsIndex extends Component
{
    use WithPerPagePagination, WithBulkActions, WithCachedRows, WithSorting;

    protected string $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];

    public ?string $search = null;

    public array $filters = [
        'focus' => [],
    ];

    public function mount() {
        $this->perPage = 12;
        $this->sorts = [
            'date' => 'desc'
        ];
    }

    public function syncWordpress() {
        GetWordPressPosts::dispatch();
        $this->dispatchBrowserEvent('toast-notification',  ['text' => 'Syncing reports from Psychedelic Invest', 'background' => 'bg-success']);
    }

    public function bulkAutoTag() {
        $count = $this->selectedRowsQuery->count();
        $trials = $this->selectedRowsQuery->get();

        foreach($trials as $trial) {
            TagReport::dispatch($trial);
        }

        $this->dispatchBrowserEvent('toast-notification',  ['text' => 'Auto-tagging ' . $count . ' reports!', 'background' => 'bg-success']);
        $this->reset('selected');
        $this->reset('selectAll');
        $this->reset('selectPage');
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
        $this->sorts = [
            'date' => 'desc'
        ];
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
        $query = Report::with(['focus'])
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
        return view('livewire.admin.entities.reports-index', [
            'records' => $this->rows,
            'focusOptions' => Focus::whereHas('reports')->withCount('reports')->orderByDesc('reports_count')->get()->toArray()
        ]);
    }
}
