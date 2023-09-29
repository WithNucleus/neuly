<?php

namespace App\Http\Livewire\Admin\Entities;

use App\Http\Livewire\Public\Entities\Traits\HasCompanyFilter;
use App\Http\Livewire\Traits\WithBulkActions;
use App\Http\Livewire\Traits\WithCachedRows;
use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Jobs\AutoTag\TagClinicalTrial;
use App\Jobs\Import\ClinicalTrial\ImportData;
use App\Models\Clinicaltrial;
use Livewire\Component;

class ClinicalTrialsIndex extends Component
{
    use WithPerPagePagination, WithBulkActions, WithCachedRows, WithSorting, HasCompanyFilter;

    protected string $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];

    public ?string $search = null;

    public array $filters = [
        'not-imported' => null,
        'missing-focus' => null
    ];

    public function mount() {
        $this->perPage = 10;
    }

    public function bulkAutoTag() {
        $count = $this->selectedRowsQuery->count();
        $trials = $this->selectedRowsQuery->get();

        foreach($trials as $trial) {
            TagClinicalTrial::dispatch($trial);
        }

        $this->dispatchBrowserEvent('toast-notification',  ['text' => 'Auto-tagging ' . $count . ' clinical trials!', 'background' => 'bg-success']);
        $this->reset('selected');
        $this->reset('selectAll');
        $this->reset('selectPage');
    }

    public function importTrials() {
        $count = $this->selectedRowsQuery->count();
        $trials = $this->selectedRowsQuery->get();

        foreach($trials as $trial) {
            ImportData::dispatch($trial);
        }

        $this->dispatchBrowserEvent('toast-notification',  ['text' => $count . ' clinical trials imported!', 'background' => 'bg-success']);
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
        $this->reset('sorts');
        $this->reset('selected');
        $this->reset('selectAll');
        $this->reset('selectPage');
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

    public function updatedPerPage() {
        $this->resetPage();
        $this->emit('gotoTop');
    }

    public function getRowsQueryProperty()
    {
        $query = Clinicaltrial::with([
                    'companies',
                    'people',
                    'focus',
                    'conditions',
                    'interventions',
                    'phases',
                    'imported',
                    'leadSponsor',
                    'responsibleParty',
                ])
                ->when($this->search, function($query, $search) {
                    return $query
                        ->where('title', 'like', '%' . $search . '%')
                        ->orWhere('brief_summary', 'like', '%' . $search . '%')
                        ->orWhere('nct_number', 'like', '%' . $search . '%');
                })
                ->when($this->filters['not-imported'], function($query) {
                    return $query->notImported();
                })
                ->when($this->filters['missing-focus'], function($query) {
                    return $query->whereDoesntHave('focus');
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
        return view('livewire.admin.entities.clinical-trials-index', [
            'records' => $this->rows
        ]);
    }
}
