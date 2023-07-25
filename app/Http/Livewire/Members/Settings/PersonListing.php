<?php

namespace App\Http\Livewire\Members\Settings;

use App\Models\Focus;
use App\Models\Person;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Throwable;

class PersonListing extends Component
{
    use WithFileUploads;

    public Person $person;
    public $photo;

    public bool $success = false;
    public bool $error = false;

    public ?string $searchFocus = null;
    public array $resultsFocus = [];

    public function rules() {
        return [
            'person.byline' => 'nullable|string|max:255',
            'person.website' => 'nullable|url|max:255',
            'person.bio' => 'nullable|string',
            'person.facebook' => 'nullable|string',
            'person.twitter' => 'nullable|string',
            'person.instagram' => 'nullable|string',
            'person.google_scholar' => 'nullable|url',
            'photo' => 'nullable|image|max:1024'
        ];
    }

    public function updatedPersonBio() {
        $this->person->bio = strip_tags($this->person->bio);
    }

    public function updatedSearchFocus() {
        if ($this->searchFocus) {
            $this->resultsFocus = Focus::where('name', 'like', '%' . $this->searchFocus . '%')
            ->take(10)
            ->pluck('name', 'id')
            ->toArray();
        } else {
            $this->reset('resultsFocus');
        }
    }

    public function addFocus($id) {
        $this->person->focus()->syncWithoutDetaching($id);
    }

    public function removeFocus($id) {
        $this->person->focus()->detach($id);
    }

    public function clearSearch($searchType) {
        if ($searchType === 'focus') {
            $this->reset('searchFocus');
            $this->reset('resultsFocus');
        }
    }

    public function submit() {
        $this->validate();

        try {
            if ($this->photo) {
                $filename = $this->person->id . $this->photo->getClientOriginalExtension();
                $this->photo->storeAs('public/people', $filename);
                $this->person->photo = $filename;
            }

            $this->person->bio = strip_tags($this->person->bio);
            $this->person->save();

            $this->success = true;
        } catch (Throwable $exception) {
            // TODO: Send a Slack message
            $this->success = false;
            $this->error = true;
        }
    }

    public function render()
    {
        return view('livewire.members.settings.person-listing');
    }
}
