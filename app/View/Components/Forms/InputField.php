<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class InputField extends Component
{
    public string $id;
    public string $name;
    public string $type;
    public ?string $placeholder;
    public ?string $classes;

    public function __construct(string $id, string $name, string $type, ?string $placeholder = null, ?string $classes = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->classes = $classes;
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Support\Htmlable|\Closure|string|\Illuminate\Contracts\Foundation\Application
    {
        return view('components.forms.input-field');
    }
}
