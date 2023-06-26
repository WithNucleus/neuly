<?php

namespace App\View\Components\LivewireFilters;

use Illuminate\View\Component;

class CheckboxMultipleWithCount extends Component
{
    public string $wireModel;
    public string $id;
    public array $options;
    public array $currentFilters;
    public string $countName;
    public ?string $class;

    public function __construct(string $wireModel, string $id, array $options, array $currentFilters, string $countName, ?string $class = null)
    {
        $this->wireModel = $wireModel;
        $this->id = $id;
        $this->options = $options;
        $this->currentFilters = $currentFilters;
        $this->countName = $countName;
        $this->class = $class;
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Support\Htmlable|\Closure|string|\Illuminate\Contracts\Foundation\Application
    {
        return view('components.livewire-filters.checkbox-multiple-with-count');
    }
}
