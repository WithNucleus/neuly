<?php

namespace App\Http\Livewire\Admin\Auth\Users;

use App\Http\Livewire\Traits\WithBulkActions;
use App\Http\Livewire\Traits\WithCachedRows;
use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSorting;
use App\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    use WithPerPagePagination, WithBulkActions, WithCachedRows, WithSorting;

    protected string $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];

    public ?string $search = null;
    public array $filters = [
        'roles' => [],
        'has-bookable-listings' => false,
        'has-person' => false,
        'team-owner' => false,
        'team-member' => false,
        'interests' => []
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
        $query = User::with([
                'roles',
                'bookableListings',
                'bookableListingRequests',
                'socialAuth',
                'relatedPerson',
                'raisedClaim',
                'ownedTeam',
                'teams',
                'dashboards',
            ])
            ->when($this->search, function($query, $search) {
                return $query
                    ->where('id', 'like', '%' . $search . '%')
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orwhereHas('roles', function($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
            })
            ->when($this->filters['roles'], function($query, $valueArray) {
                return $query->whereHas('roles', function($query) use ($valueArray) {
                    $query->whereIn('name', $valueArray);
                });
            })
            ->when($this->filters['has-bookable-listings'], function($query) {
                return $query->whereHas('bookableListings');
            })
            ->when($this->filters['has-person'], function($query) {
                return $query->whereHas('relatedPerson');
            })
            ->when($this->filters['team-owner'], function($query) {
                return $query->whereHas('ownedTeam');
            })
            ->when($this->filters['team-member'], function($query) {
                return $query->whereHas('teams');
            })
            ->when($this->filters['interests'], function($query, $valueArray) {
                return $query->whereJsonContains('interests', $valueArray);
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
        return view('livewire.admin.auth.users.index', [
            'records' => $this->rows,
            'roleOptions' => Role::whereHas('users')->withCount('users')->get()->toArray(),
            'interestOptions' => User::INTERESTS
        ]);
    }
}
