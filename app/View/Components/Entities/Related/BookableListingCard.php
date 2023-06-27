<?php

namespace App\View\Components\Entities\Related;

use App\Models\BookableListing;
use Illuminate\View\Component;

class BookableListingCard extends Component
{
    public BookableListing $bookableListing;

    public function __construct(BookableListing $bookableListing)
    {
        $this->bookableListing = $bookableListing;
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Support\Htmlable|string|\Closure|\Illuminate\Contracts\Foundation\Application
    {
        return view('components.entities.related.bookable-listing-card');
    }
}
