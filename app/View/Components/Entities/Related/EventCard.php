<?php

namespace App\View\Components\Entities\Related;

use App\Models\Event;
use Illuminate\View\Component;

class EventCard extends Component
{
    public Event $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Support\Htmlable|string|\Closure|\Illuminate\Contracts\Foundation\Application
    {
        return view('components.entities.related.event-card');
    }
}
