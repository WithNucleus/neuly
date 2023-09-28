<?php

namespace App\Http\Livewire\Members\Notifications;

use App\User;
use Livewire\Component;

class NotificationBadge extends Component
{
    public User $user;

    public function render()
    {
        return view('livewire.members.notifications.notification-badge');
    }
}
