<?php

namespace App\View\Components\Entities\Related;

use App\Models\Person;
use Illuminate\View\Component;

class PersonCard extends Component
{
    public Person $person;
    public ?string $classes;

    public function __construct(Person $person, ?string $classes)
    {
        $this->person = $person;
        $this->classes = $classes;
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Support\Htmlable|string|\Closure|\Illuminate\Contracts\Foundation\Application
    {
        return view('components.entities.related.person-card');
    }
}
