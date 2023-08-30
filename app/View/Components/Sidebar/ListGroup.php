<?php

namespace App\View\Components\Sidebar;

use Illuminate\View\Component;

class ListGroup extends Component
{
    public string $groupRoute;
    public string $label;

    public function __construct(string $groupRoute, string $label)
    {
        $this->groupRoute = $groupRoute;
        $this->label = $label;
    }

    public function render()
    {
        return view('components.sidebar.list-group');
    }
}
