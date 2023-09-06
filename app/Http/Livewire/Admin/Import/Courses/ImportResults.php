<?php

namespace App\Http\Livewire\Admin\Import\Courses;

use App\Http\Livewire\Traits\WithBulkActions;
use App\Http\Livewire\Traits\WithCachedRows;
use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\Course;
use App\Models\ImportResult;
use Livewire\Component;

class ImportResults extends Component
{
    use WithPerPagePagination, WithBulkActions, WithCachedRows, WithSorting;

    protected string $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];

    public ?string $search = null;

    public $selectedResult;

    public function mount() {
        $this->sorts = [
            'updated_at' => 'desc'
        ];

        $this->perPage = 20;
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

    public function getRowsQueryProperty()
    {
        $query = ImportResult::where('entity', Course::class)
                ->when($this->search, function($query, $search) {
                    return $query
                        ->where('type', 'like', '%' . $search . '%');
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
        return view('livewire.admin.import.courses.import-results', [
            'records' => $this->rows
        ]);
    }
}
