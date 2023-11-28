<?php

namespace App\Http\Livewire\Public\Entities\Traits;

use App\Models\Location;

trait HasLocationFilterWithQuery {

    public ?string $locationSearch = null;
    public array $locationSearchResults = [];

    public function returnLocationSearch($entity, $queryField, $queryComparison, $queryValue) {
        if($this->locationSearch) {
            $this->locationSearchResults = Location::whereRelation("{$entity}", $queryField, $queryComparison, $queryValue)
                ->withCount(["{$entity} AS related_count" => function($query) use ($queryField, $queryComparison, $queryValue) {
                    $query->where($queryField, $queryComparison, $queryValue);
                }])
                ->where('name', 'like', '%' . $this->locationSearch . '%')
                ->orderByDesc('related_count')
                ->get()
                ->toArray();
        } else {
            $this->locationSearchResults = Location::whereRelation("{$entity}", $queryField, $queryComparison, $queryValue)
                ->withCount(["{$entity} as related_count" => function($query) use ($queryField, $queryComparison, $queryValue) {
                    $query->where($queryField, $queryComparison, $queryValue);
                }])
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
