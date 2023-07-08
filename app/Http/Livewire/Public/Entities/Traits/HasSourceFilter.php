<?php
namespace App\Http\Livewire\Public\Entities\Traits;

use App\Models\DataFeed;

trait HasSourceFilter {
    public ?string $sourceSearch = null;
    public array $sourceSearchResults = [];

    public function returnSourceSearch($entity) {
        if($this->sourceSearch) {
            $this->sourceSearchResults = DataFeed::whereHas($entity)
                ->withCount("{$entity} as related_count")
                ->orderByDesc('related_count')
                ->where('name', 'like', '%' . $this->sourceSearch . '%')
                ->get()
                ->toArray();
        } else {
            $this->sourceSearchResults = DataFeed::whereHas($entity)
                ->withCount("{$entity} as related_count")
                ->orderByDesc('related_count')
                ->take(5)
                ->get()
                ->toArray();
        }
    }

    public function setSourceFilter($value) {
        $this->filters['sources'][] = $value;
        $this->reset('sourceSearch');
        $this->reset('sourceSearchResults');
    }
}
