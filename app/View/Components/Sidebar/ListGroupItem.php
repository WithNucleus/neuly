<?php

namespace App\View\Components\Sidebar;

use Illuminate\View\Component;

class ListGroupItem extends Component
{
    public string $url;
    public string $label;

    public function __construct(string $url, string $label)
    {
        $this->url = $url;
        $this->label = $label;
    }

    public function render()
    {
        return view('components.sidebar.list-group-item');
    }
}
