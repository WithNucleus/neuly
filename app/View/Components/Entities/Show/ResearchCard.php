<?php

namespace App\View\Components\Entities\Show;

use App\Models\Research;
use Illuminate\View\Component;

class ResearchCard extends Component
{
    public Research $research;

    public function __construct(Research $research)
    {
        $this->research = $research;
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Support\Htmlable|string|\Closure|\Illuminate\Contracts\Foundation\Application
    {
        $resources = json_decode($this->research->resources);

        return view('components.entities.show.research-card', [
            'resources' => $resources
        ]);
    }
}
