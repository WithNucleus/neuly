<?php

namespace App\Http\Livewire\Admin\Import\ClinicalTrials;

use App\Http\Livewire\Traits\WithBulkActions;
use App\Http\Livewire\Traits\WithCachedRows;
use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\ImportedEntity;
use Livewire\Component;

class Index extends Component
{
    use WithPerPagePagination, WithBulkActions, WithCachedRows, WithSorting;

    protected string $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];

    public ?string $search = null;

    public array $filters = [
        'has-entity' => false,
        'has-errors' => false
    ];

    public $selectedResult;

    public function mount() {
        $this->sorts = [
            'updated_at' => 'desc'
        ];

        $this->perPage = 50;
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
    }

    public function getRowsQueryProperty()
    {
        $query = ImportedEntity::with(['importable'])
                ->when($this->search, function($query, $search) {
                    return $query
                        ->where('name', 'like', '%' . $search . '%');
                })
                ->when($this->filters['has-entity'], function($query) {
                    return $query->doesntHave('importable');
                })
                ->when($this->filters['has-errors'], function($query) {
                    return $query->whereNotNull('errors');
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
        return view('livewire.admin.import.clinical-trials.index', [
            'records' => $this->rows,
        ]);
    }
}
