<?php

namespace App\Http\Livewire\Admin\Emails\Emails;

use App\Http\Livewire\Traits\WithBulkActions;
use App\Http\Livewire\Traits\WithCachedRows;
use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Jobs\EmailMarketing\ReplaceMergeValues;
use App\Models\Email;
use Livewire\Component;

class Index extends Component
{
    use WithPerPagePagination, WithBulkActions, WithCachedRows, WithSorting;

    protected string $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];

    public ?string $search = null;
    public array $filters = [
        'status' => [],
    ];

    public function mount() {
        $this->perPage = 10;
        $this->sorts = [
            'created_at' => 'desc'
        ];
    }

    public function deleteRecords() {
        $count = $this->selectedRowsQuery->deletable()->count();
        $this->selectedRowsQuery->deletable()->delete();

        $this->dispatchBrowserEvent('toast-notification',  ['text' => 'Deleted ' . $count . ' emails', 'background' => 'bg-success']);
        $this->reset('selected');
        $this->reset('selectAll');
        $this->reset('selectPage');
    }

    public function replaceMergeValues() {
        $count = $this->selectedRowsQuery->canReplaceMergeValues()->count();
        $emails =$this->selectedRowsQuery->canReplaceMergeValues()->get();

        foreach($emails as $email) {
            ReplaceMergeValues::dispatch($email);
        }

        $this->dispatchBrowserEvent('toast-notification',  ['text' => 'Replacing merge values for ' . $count . ' emails', 'background' => 'bg-success']);
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
        $query = Email::with([
                'emailJourney',
                'emailSequence',
                'emailTemplate',
                'user',
            ])
            ->when($this->search, function($query, $search) {
                return $query
                    ->where('to_name', 'like', '%' . $search . '%')
                    ->orWhere('to_email', 'like', '%' . $search . '%')
                    ->orWhere('subject', 'like', '%' . $search . '%')
                    ->orwhereHas('emailJourney', function($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orwhereHas('emailTemplate', function($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orwhereHas('user', function($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
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
        return view('livewire.admin.emails.emails.index', [
            'records' => $this->rows,
            'statusOptions' => Email::orderBy('status')->pluck('status')->unique()->toArray()
        ]);
    }
}
