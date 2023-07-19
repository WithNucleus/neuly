<?php

namespace App\Http\Livewire\Public\Entities\Show;

use App\Models\Company;
use App\Models\Focus;
use App\Models\MediaItem;
use App\Models\Person;
use Livewire\Component;

class NewsArticleWidget extends Component
{
    public MediaItem $record;
    public bool $error = false;
    public $selectedTag;

    public $organizationSearch;
    public $organizationsList = [];

    public $personSearch;
    public $peopleList = [];

    public function saveTag() {
        if ($this->selectedTag == '') {
            $this->error = true;
            $this->success = false;
        } else {
            $this->error = false;
            $this->record->focus()->syncWithoutDetaching($this->selectedTag);
        }
    }

    public function updatedOrganizationSearch() {
        if ($this->organizationSearch) {
            $this->organizationsList = Company::where('name', 'like', '%' . $this->organizationSearch . '%')->take(5)->get()->toArray();
        } else {
            $this->reset('organizationsList');
        }
    }

    public function saveOrganization($id) {
        $this->record->companies()->syncWithoutDetaching($id);
        $this->reset('organizationSearch');
        $this->reset('organizationsList');
    }

    public function updatedPersonSearch() {
        if ($this->personSearch) {
            $this->peopleList = Person::where('name', 'like', '%' . $this->personSearch . '%')->take(5)->get()->toArray();
        } else {
            $this->reset('peopleList');
        }
    }

    public function savePerson($id) {
        $this->record->people()->syncWithoutDetaching($id);
        $this->reset('personSearch');
        $this->reset('peopleList');
    }

    public function clearField($field, $optional = null) {
        $this->reset($field);

        if ($optional) {
            $this->reset($optional);
        }
    }

    public function render()
    {
        return view('livewire.public.entities.show.news-article-widget', [
            'tags' => Focus::drugs()->orderBy('name')->get(),
            'organizations' => Company::public()->orderBy('name')->get(),
        ]);
    }
}
