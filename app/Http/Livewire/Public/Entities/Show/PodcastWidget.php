<?php

namespace App\Http\Livewire\Public\Entities\Show;

use App\Models\MediaItem;
use Livewire\Component;

class PodcastWidget extends Component
{
    public MediaItem $record;
    public bool $hideSource = false;

    public function render()
    {
        return view('livewire.public.entities.show.podcast-widget');
    }
}
