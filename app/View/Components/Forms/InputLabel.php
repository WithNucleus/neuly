<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class InputLabel extends Component
{
    public string $id;
    public string $name;
    public ?string $classes;

    public function __construct(string $id, string $name, ?string $classes = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->classes = $classes;
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Support\Htmlable|string|\Closure|\Illuminate\Contracts\Foundation\Application
    {
        return view('components.forms.input-label');
    }
}
