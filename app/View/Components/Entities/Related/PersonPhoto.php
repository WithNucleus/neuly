<?php

namespace App\View\Components\Entities\Related;

use App\Models\Person;
use Illuminate\View\Component;

class PersonPhoto extends Component
{
    public Person $person;

    public function __construct(Person $person)
    {
        $this->person = $person;
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Support\Htmlable|string|\Closure|\Illuminate\Contracts\Foundation\Application
    {
        return view('components.entities.related.person-photo');
    }
}
