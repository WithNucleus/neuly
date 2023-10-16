<?php

namespace App\Http\Livewire\Admin\Emails\Preferences;

use App\Http\Livewire\Traits\WithBulkActions;
use App\Http\Livewire\Traits\WithCachedRows;
use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\EmailPreference;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;

class Index extends Component
{
    use WithPerPagePagination, WithBulkActions, WithCachedRows, WithSorting;

    protected string $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];

    public ?string $search = null;
    public array $filters = [
        'blacklist' => null,
        'unregistered' => null,
    ];

    public ?string $ip;

    public function mount(Request $request) {
        $this->perPage = 10;
        $this->ip = $request->getClientIp();
    }

    public function addToBlacklist() {
        $count = count($this->selected);
        $now = Carbon::now();

        EmailPreference::whereIn('email', $this->selected)->update([
            'do_not_email' => true,
            'opt_out' => $now,
            'opt_out_ip' => $this->ip
        ]);

        $this->dispatchBrowserEvent('toast-notification',  ['text' => 'Added ' . $count . ' emails to the blacklist', 'background' => 'bg-success']);
        $this->reset('selected');
        $this->reset('selectAll');
        $this->reset('selectPage');
    }

    public function optOutMarketing() {
        $count = count($this->selected);

        EmailPreference::whereIn('email', $this->selected)->update([
            'marketing' => false,
        ]);

        $this->dispatchBrowserEvent('toast-notification',  ['text' => 'Opted out ' . $count . ' emails from marketing list', 'background' => 'bg-success']);
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
        $query = EmailPreference::with([
                'user',
            ])
            ->withCount(['emails'])
            ->when($this->search, function($query, $search) {
                return $query
                    ->where('email', 'like', '%' . $search . '%')
                    ->orWhere('user_id', $search)
                    ->orWhere('opt_in_ip', $search)
                    ->orWhere('opt_out_ip', $search)
                    ->orwhereHas('user', function($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
            })
            ->when($this->filters['blacklist'], function($query) {
                return $query->blacklist();
            })
            ->when($this->filters['unregistered'], function($query) {
                return $query->unregistered();
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
        return view('livewire.admin.emails.preferences.index', [
            'records' => $this->rows
        ]);
    }
}
