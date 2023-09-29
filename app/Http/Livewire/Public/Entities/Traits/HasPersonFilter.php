<?php
namespace App\Http\Livewire\Public\Entities\Traits;

use App\Models\Person;

trait HasPersonFilter {
    public ?string $personSearch = null;
    public array $personSearchResults = [];

    public function returnPersonSearch($entity) {
        if($this->personSearch) {
            $this->personSearchResults = Person::whereHas($entity)
                ->withCount("{$entity} as related_count")
                ->orderByDesc('related_count')
                ->where('name', 'like', '%' . $this->personSearch . '%')
                ->get()
                ->toArray();
        } else {
            $this->personSearchResults = Person::whereHas($entity)
                ->withCount("{$entity} as related_count")
                ->orderByDesc('related_count')
                ->take(5)
                ->get()
                ->toArray();
        }
    }

    public function setPersonFilter($value) {
        $this->filters['people'][] = $value;
        $this->reset('personSearch');
        $this->reset('personSearchResults');
    }
}
