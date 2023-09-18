<?php

namespace App\Http\Livewire\Admin\Edu;

use App\Http\Livewire\Traits\WithBulkActions;
use App\Http\Livewire\Traits\WithCachedRows;
use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\EduRequest;
use App\Models\Feedback;
use App\User;
use Livewire\Component;

class StudentsList extends Component
{
    use WithPerPagePagination, WithBulkActions, WithCachedRows, WithSorting;

    protected string $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];

    public ?string $search = null;
    public array $filters = [
        'type' => [],
        'status' => []
    ];

    public $selectedStudent;
    public ?string $assignedUser = NULL;

    public $statusActionOptions = [
        EduRequest::STATUS_COMPLETED => [
            'label' => 'Mark completed',
            'button' => 'accent'
        ],
        EduRequest::STATUS_AWAITING_RESPONSE => [
            'label' => 'Needs response',
            'button' => 'warning'
        ],
        EduRequest::STATUS_IN_PROGRESS => [
            'label' => 'In progress',
            'button' => 'warning-bright'
        ],
        EduRequest::STATUS_NEW => [
            'label' => 'Re-open',
            'button' => 'primary'
        ]
    ];

    public function selectStudent($id) {
        $this->selectedStudent = EduRequest::findOrFail($id);
        $this->assignedUser = $this->selectedStudent->assignee_id;
        $this->dispatchBrowserEvent('show-dynamic-modal');
    }

    public function assignStudent() {

        if($this->assignedUser) {
            $this->selectedStudent->assignee_id = $this->assignedUser;
        } else {
            $this->selectedStudent->assignee_id = NULL;
        }

        $this->selectedStudent->save();
        $this->selectedStudent->refresh();
        $this->dispatchBrowserEvent('hide-dynamic-modal');
    }

    public function changeStatus($status) {
        $this->selectedStudent->status = $status;
        $this->selectedStudent->save();
        $this->selectedStudent->refresh();
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
        $query = EduRequest::with([
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
        return view('livewire.admin.edu.students-list', [
            'records' => $this->rows,
            'typeOptions' => EduRequest::TYPES,
            'statusOptions' => EduRequest::STATUSES,
            'internalUsers' => User::whereHas('roles', function($query) {
                    $query->whereIn('name', ['Admin', 'Editor']);
                })->get()
        ]);
    }
}
