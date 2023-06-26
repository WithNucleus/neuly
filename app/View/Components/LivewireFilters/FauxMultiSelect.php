<?php

namespace App\View\Components\LivewireFilters;

use Illuminate\View\Component;

class FauxMultiSelect extends Component
{
    public string $wireModelSearch;
    public string $wireModelFilter;
    public string $label;
    public string $checkboxIdPrefix;
    public string $setFilterFunction;
    public array $searchResults;
    public array $currentFilters;

    public function __construct(string $wireModelSearch, string $wireModelFilter, string $label, string $checkboxIdPrefix, string $setFilterFunction, array $searchResults, array $currentFilters)
    {
        $this->wireModelSearch = $wireModelSearch;
        $this->wireModelFilter = $wireModelFilter;
        $this->label = $label;
        $this->checkboxIdPrefix = $checkboxIdPrefix;
        $this->setFilterFunction = $setFilterFunction;
        $this->searchResults = $searchResults;
        $this->currentFilters = $currentFilters;
    }

    public function render()
    {
        return view('components.livewire-filters.faux-multi-select');
    }
}
