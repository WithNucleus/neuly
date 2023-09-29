<?php

namespace App\View\Components\Entities\Related;

use App\Models\MediaItem;
use Illuminate\View\Component;

class MediaItemCard extends Component
{
    public MediaItem $mediaItem;

    public function __construct(MediaItem $mediaItem)
    {
        $this->mediaItem = $mediaItem;
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Support\Htmlable|string|\Closure|\Illuminate\Contracts\Foundation\Application
    {
        return view('components.entities.related.media-item-card');
    }
}
