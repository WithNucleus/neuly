<?php

namespace App\Http\Livewire\Admin\Emails\Invitations;

use App\Http\Livewire\Traits\WithBulkActions;
use App\Http\Livewire\Traits\WithCachedRows;
use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\Email;
use App\Models\UserInvitation;
use Livewire\Component;

class Index extends Component
{
    use WithPerPagePagination, WithBulkActions, WithCachedRows, WithSorting;

    protected string $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];

    public ?string $search = null;
    public array $filters = [
        'registered' => [],
    ];

    public function mount() {
        $this->perPage = 10;
        $this->sorts = [
            'created_at' => 'desc'
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
        $query = UserInvitation::with([
                'emailPreference',
                'inviter',
                'invitee',
            ])
            ->when($this->search, function($query, $search) {
                return $query
                    ->where('email_preference_email', 'like', '%' . $search . '%')
                    ->orWhereHas('emailPreference', function($query) use ($search) {
                        $query->where('email', 'like', '%' . $search . '%');
                    })
                    ->orwhereHas('inviter', function($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%')->orWhere('email', 'like', '%' . $search . '%');
                    })
                    ->orwhereHas('invitee', function($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
            })
            ->when($this->filters['registered'], function($query, $valueArray) {
                return $query->whereNotNull('invitee_id');
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
        return view('livewire.admin.emails.invitations.index', [
            'records' => $this->rows,
        ]);
    }
}
