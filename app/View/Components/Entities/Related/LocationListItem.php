<?php

namespace App\View\Components\Entities\Related;

use App\Models\Location;
use Illuminate\View\Component;

class LocationListItem extends Component
{
    public Location $location;

    public function __construct(Location $location)
    {
        $this->location = $location;
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Support\Htmlable|string|\Closure|\Illuminate\Contracts\Foundation\Application
    {
        return view('components.entities.related.location-list-item');
    }
}
