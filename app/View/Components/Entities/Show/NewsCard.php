<?php

namespace App\View\Components\Entities\Show;

use App\Models\MediaItem;
use Illuminate\View\Component;

class NewsCard extends Component
{
    public MediaItem $record;

    public function __construct(MediaItem $record)
    {
        $this->record = $record;
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Support\Htmlable|string|\Closure|\Illuminate\Contracts\Foundation\Application
    {
        return view('components.entities.show.news-card');
    }
}
