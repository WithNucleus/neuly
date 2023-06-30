<?php

namespace App\Http\Livewire\Public\Entities\Traits;

use App\Models\Location;

trait HasLocationFilter {

    public ?string $locationSearch = null;
    public array $locationSearchResults = [];

    public function returnLocationSearch($entity) {
        if($this->locationSearch) {
            $this->locationSearchResults = Location::whereHas($entity)
                ->withCount("{$entity} as related_count")
                ->where('name', 'like', '%' . $this->locationSearch . '%')
                ->orderByDesc('related_count')
                ->get()
                ->toArray();
        } else {
            $this->locationSearchResults = Location::whereHas($entity)
                ->withCount("{$entity} as related_count")
                ->orderByDesc('related_count')
                ->take(5)
                ->get()
                ->toArray();
        }
    }

    public function setLocationFilter($value) {
        $this->filters['locations'][] = $value;
        $this->reset('locationSearch');
        $this->reset('locationSearchResults');
    }
}
