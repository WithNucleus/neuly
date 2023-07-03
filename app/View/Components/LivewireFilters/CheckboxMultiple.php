<?php

namespace App\View\Components\LivewireFilters;

use Illuminate\View\Component;

class CheckboxMultiple extends Component
{
    public string $wireModel;
    public string $id;
    public array $options;
    public array $currentFilters;
    public ?string $class;

    public function __construct(string $wireModel, string $id, array $options, array $currentFilters, ?string $class = null)
    {
        $this->wireModel = $wireModel;
        $this->id = $id;
        $this->options = $options;
        $this->currentFilters = $currentFilters;
        $this->class = $class;
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Support\Htmlable|\Closure|string|\Illuminate\Contracts\Foundation\Application
    {
        return view('components.livewire-filters.checkbox-multiple');
    }
}
