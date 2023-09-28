<?php

namespace App\Http\Livewire\Admin\Research;

use App\Http\Livewire\Traits\WithBulkActions;
use App\Http\Livewire\Traits\WithCachedRows;
use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\ResearchRequest;
use App\User;
use Livewire\Component;

class ResearchRequestsList extends Component
{
    use WithPerPagePagination, WithBulkActions, WithCachedRows, WithSorting;

    protected string $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];

    public ?string $search = null;
    public array $filters = [
        'type' => [],
        'status' => []
    ];

    public $selectedRecord;
    public ?string $assignedUser = NULL;

    public array $statusActionOptions = [];

    public function mount() {
        $this->statusActionOptions = ResearchRequest::crmActionItems();
        $this->sorts = [
            'created_at' => 'desc'
        ];
    }

    public function selectRecord($id) {
        $this->selectedRecord = ResearchRequest::findOrFail($id);
        $this->assignedUser = $this->selectedRecord->assignee_id;
        $this->dispatchBrowserEvent('show-dynamic-modal');
    }

    public function assignRecord() {

        if($this->assignedUser) {
            $this->selectedRecord->assignee_id = $this->assignedUser;
        } else {
            $this->selectedRecord->assignee_id = NULL;
        }

        $this->selectedRecord->save();
        $this->selectedRecord->refresh();
        $this->dispatchBrowserEvent('hide-dynamic-modal');
    }

    public function changeStatus($status) {
        $this->selectedRecord->status = $status;
        $this->selectedRecord->save();
        $this->selectedRecord->refresh();
        $this->dispatchBrowserEvent('hide-dynamic-modal');
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

    public function updatedPerPage() {
        $this->resetPage();
        $this->emit('gotoTop');
    }

    public function getRowsQueryProperty()
    {
        $query = ResearchRequest::with([
                'entity',
                'user',
            ])
            ->when($this->search, function($query, $search) {
                return $query
                    ->where('name', 'like', '%' . $search . '%')
                    ->where('email', 'like', '%' . $search . '%')
                    ->orwhereHas('user', function($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orwhereHas('entity', function($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
            })
            ->when($this->filters['type'], function($query, $valueArray) {
                return $query->whereIn('type', $valueArray);
            })
            ->when($this->filters['status'], function($query, $valueArray) {
                return $query->whereIn('status', $valueArray);
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
        return view('livewire.admin.research.research-requests-list', [
            'records' => $this->rows,
            'typeOptions' => ResearchRequest::TYPES,
            'statusOptions' => ResearchRequest::STATUSES,
            'internalUsers' => User::whereHas('roles', function($query) {
                $query->whereIn('name', ['Admin', 'Editor']);
            })->get()
        ]);
    }
}
