<?php

namespace App\Http\Livewire\Admin\Edu;

use App\Http\Livewire\Traits\WithBulkActions;
use App\Http\Livewire\Traits\WithCachedRows;
use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Jobs\EmailMarketing\CreateAdminEmailsFromArray;
use App\Models\EduRequest;
use App\Models\EmailTrigger;
use App\User;
use Livewire\Component;

class StudentsList extends Component
{
    use WithPerPagePagination, WithBulkActions, WithCachedRows, WithSorting;

    protected string $paginationTheme = 'bootstrap';
    protected $queryString = ['search', 'find'];

    public ?string $search = null;
    public array $filters = [
        'type' => [],
        'status' => [],
        'certifications' => false
    ];

    public ?int $find = null;

    public $selectedStudent;
    public ?int $assignedUser = NULL;

    public array $statusActionOptions = [];

    public function mount() {
        $this->statusActionOptions = EduRequest::crmActionItems();
        $this->sorts = [
            'created_at' => 'desc'
        ];
    }

    public function selectStudent($id) {
        $this->selectedStudent = EduRequest::findOrFail($id);
        $this->assignedUser = $this->selectedStudent->assignee_id;
        $this->dispatchBrowserEvent('show-dynamic-modal');
    }

    public function assignStudent() {

        if($this->assignedUser) {
            $this->selectedStudent->assignee_id = $this->assignedUser;
            CreateAdminEmailsFromArray::dispatch(EmailTrigger::TRIGGER_CRM_ASSIGNED, [$this->assignedUser], ['url' => route('adminx.edu.students', ['find' => $this->selectedStudent->id])]);
            $this->dispatchBrowserEvent('toast-notification',  ['text' => 'Email notification sent!', 'background' => 'bg-success']);
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

        if ($status === EduRequest::STATUS_AWAITING_RESPONSE) {
            if($this->selectedStudent->assignee_id) {
                CreateAdminEmailsFromArray::dispatch(EmailTrigger::TRIGGER_CRM_FOLLOW_UP, [$this->selectedStudent->assignee_id], ['url' => route('adminx.edu.students', ['find' => $this->selectedStudent->id])]);
                $this->dispatchBrowserEvent('toast-notification',  ['text' => 'Email notification sent!', 'background' => 'bg-success']);
            } else {
                $this->dispatchBrowserEvent('toast-notification',  ['text' => 'There is no assigned user to be notified!', 'background' => 'bg-danger']);
            }
        }

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
        $this->reset('find');
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
            })
            ->when($this->filters['certifications'], function($query) {
                return $query->whereJsonContains('data->certifications', true);
            })
            ->when($this->find, function($query, $id) {
                return $query->where('id', $id);
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
