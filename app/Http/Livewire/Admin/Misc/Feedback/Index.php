<?php

namespace App\Http\Livewire\Admin\Misc\Feedback;

use App\Http\Livewire\Traits\WithBulkActions;
use App\Http\Livewire\Traits\WithCachedRows;
use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\Feedback;
use App\User;
use Livewire\Component;

class Index extends Component
{
    use WithPerPagePagination, WithBulkActions, WithCachedRows, WithSorting;

    protected string $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];

    public ?string $search = null;
    public array $filters = [
        'type' => [],
        'status' => [],
    ];

    public $selectedFeedback;
    public ?string $assignedUser = NULL;

    public $statusActionOptions = [
        Feedback::STATUS_CLOSED => [
            'label' => 'Mark completed',
            'button' => 'accent'
        ],
        Feedback::STATUS_AWAITING_RESPONSE => [
            'label' => 'Needs response',
            'button' => 'warning'
        ],
        Feedback::STATUS_IN_PROGRESS => [
            'label' => 'In progress',
            'button' => 'warning-bright'
        ],
        Feedback::STATUS_OPEN => [
            'label' => 'Re-open',
            'button' => 'primary'
        ]
    ];

    public function mount() {
        $this->perPage = 10;
        $this->sorts = [
            'created_at' => 'desc'
        ];
    }

    public function selectFeedback($id) {
        $this->selectedFeedback = Feedback::findOrFail($id);
        $this->assignedUser = $this->selectedFeedback->assignee_id;
        $this->dispatchBrowserEvent('show-dynamic-modal');
    }

    public function changeStatus($status) {
        $this->selectedFeedback->status = $status;
        $this->selectedFeedback->save();
        $this->selectedFeedback->refresh();
        $this->dispatchBrowserEvent('hide-dynamic-modal');
    }

    public function assignFeedback() {

        if($this->assignedUser) {
            $this->selectedFeedback->assignee_id = $this->assignedUser;
        } else {
            $this->selectedFeedback->assignee_id = NULL;
        }

        $this->selectedFeedback->save();
        $this->selectedFeedback->refresh();
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
        $query = Feedback::with([
                'user',
            ])
            ->when($this->search, function($query, $search) {
                return $query
                    ->where('title', 'like', '%' . $search . '%')
                    ->orWhere('type', 'like', '%' . $search . '%')
                    ->orWhere('status', 'like', '%' . $search . '%')
                    ->orWhere('content', 'like', '%' . $search . '%')
                    ->orWhere('url', 'like', '%' . $search . '%')
                    ->orWhere('user_name', 'like', '%' . $search . '%')
                    ->orWhere('user_name', 'like', '%' . $search . '%')
                    ->orWhere('organization', 'like', '%' . $search . '%')
                    ->orWhere('job_title', 'like', '%' . $search . '%')
                    ->orwhereHas('user', function($query) use ($search) {
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
        return view('livewire.admin.misc.feedback.index', [
            'records' => $this->rows,
            'typeOptions' => Feedback::pluck('type')->unique()->toArray(),
            'statusOptions' => Feedback::pluck('status')->unique()->toArray(),
            'internalUsers' => User::whereHas('roles', function($query) {
                    $query->whereIn('name', ['Admin', 'Editor']);
                })->get()
        ]);
    }
}
