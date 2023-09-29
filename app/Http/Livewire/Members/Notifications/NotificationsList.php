<?php

namespace App\Http\Livewire\Members\Notifications;

use App\Http\Livewire\Traits\WithBulkActions;
use App\Http\Livewire\Traits\WithCachedRows;
use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NotificationsList extends Component
{
    use WithPerPagePagination, WithBulkActions, WithCachedRows, WithSorting;

    protected string $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];

    public int $unreadCount = 0;

    public ?string $search = null;
    public bool $hideRead = false;

    public bool $dashboard = false;

    public function mount() {

        if ($this->dashboard) {
            $this->perPage = 5;
        } else {
            $this->perPage = 10;
        }

        $this->updateUnreadCount();
        $this->sorts = [
            'was_read' => 'asc',
            'created_at' => 'desc'
        ];
    }

    public function updateUnreadCount() {
        $this->unreadCount = Auth::user()->notifications()->unseen()->count();
    }

    public function markUnread () {
        $count = $this->selectedRowsQuery->count();
        $notifications = $this->selectedRowsQuery;
        $notifications->update([
            'was_read' => 0
        ]);

        $this->dispatchBrowserEvent('toast-notification',  ['text' => 'Marking ' . $count . ' notifications unread!', 'background' => 'bg-success']);
        $this->reset('selected');
        $this->reset('selectAll');
        $this->reset('selectPage');
        $this->updateUnreadCount();
    }

    public function markRead () {
        $count = $this->selectedRowsQuery->count();
        $notifications = $this->selectedRowsQuery;
        $notifications->update([
            'was_read' => 1
        ]);

        $this->dispatchBrowserEvent('toast-notification',  ['text' => 'Marking ' . $count . ' notifications read!', 'background' => 'bg-success']);
        $this->reset('selected');
        $this->reset('selectAll');
        $this->reset('selectPage');
        $this->updateUnreadCount();
    }

    public function selectNotification($id) {
        $this->selected[] = $id;
    }

    public function updatingSearch() {
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

    public function getRowsQueryProperty()
    {
        $query = Notification::ofUser(Auth::id())->with(['notifier'])
                ->when($this->search, function($query, $search) {
                    return $query->articles()->where(function ($query) use ($search) {
                        return $query
                            ->where('title', 'like', '%' . $search . '%');
                   });
                })
                ->when($this->hideRead, function($query) {
                    return $query->where('was_read', 0);
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
        return view('livewire.members.notifications.notifications-list', [
            'records' => $this->rows
        ]);
    }
}
