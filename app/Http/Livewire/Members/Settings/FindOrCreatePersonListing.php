<?php

namespace App\Http\Livewire\Members\Settings;

use App\Models\Person;
use App\User;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Spatie\SlackAlerts\Facades\SlackAlert;
use Throwable;

class FindOrCreatePersonListing extends Component
{
    public User $user;

    public ?string $personSearch;
    public ?int $selectedPersonId;
    public array $personResults = [];

    public ?string $personLink = null;

    public bool $showCreateForm = false; // TODO: TEMP TRUE FOR DEV

    public ?string $name = null;
    public ?string $email = null;
    public ?string $byline = null;
    public ?string $website = null;

    public bool $successfulPersonCreation = false;
    public bool $successfulPersonClaimed = false;
    public ?string $errorPersonCreation = null;
    public ?string $manualClaimSent = null;

    public function rules() {
        return [
            'name' => 'required|min:3',
            'email' => [
                'required',
                'email',
                Rule::unique('people', 'email')
            ],
            'byline' => 'nullable',
            'website' => 'nullable|url',
        ];
    }

    public function mount() {
        $this->personSearch = $this->user->full_name;
        $this->name = $this->user->full_name;
        $this->email = $this->user->email;

        $this->personResults = $this->searchPeopleByName($this->user->full_name);
    }

    private function searchPeopleByName($name) {
        return Person::where('name', 'like', '%' . $name . '%')
            ->whereNull('user_id')
            ->take(10)
            ->get()
            ->toArray();
    }

    public function updatedPersonSearch() {
        if($this->personSearch) {
            $this->personResults = $this->searchPeopleByName($this->personSearch);
        } else {
            $this->reset('personResults');
        }
    }

    public function selectPerson($id) {
        $person = Person::findOrFail($id);
        $this->selectedPersonId = $id;
    }

    public function createNewPerson() {
        $this->showCreateForm = true;
        $this->name = $this->personSearch;
    }

    public function claimExistingPerson() {
        $person = Person::findOrFail($this->selectedPersonId);
        $this->personLink = route('discover.people.show', $person->slug);
        $userRoute = route('user.edit', $this->user->id);

        if ($this->user->email === $person->email) {
            // Auto-verified by email
            $person->user_id = $this->user->id;
            $person->save();
            $this->user->person_id = $person->id;
            $this->user->save();
            $this->successfulPersonClaimed = true;
        } else {

            SlackAlert::to('test')->blocks([
                [
                    "type" => "section",
                    "text" => [
                    "type" => "mrkdwn",
                        "text" => "<@sydney> {$this->user->fullname} claimed the person listing for {$person->name}\n\n<{$this->personLink}|View Person>\n<{$userRoute}|View User>"
                    ],
                ]
            ]);

            $this->manualClaimSent = "We're unable to verify you automatically by email or social accounts, so we've sent the request to our admins. We'll get back to you as soon as possible. Thanks!";

            // TODO: Need to check by email/social and see if those are connected
            // Ways to verify
            // 1. Does it have an email on file? If so we can send one and if you verify, you're good
            // 2. Verify by social channels
            // 3. Send us a notification and we do it
        }
    }

    public function submit() {
        $this->validate();

        try {
            $person = Person::create([
                'name' => $this->name,
                'email' => $this->email,
                'website' => $this->website,
                'byline' => $this->byline
            ]);

            $person->user_id = $this->user->id;
            $person->save();
            $this->user->person_id = $person->id;
            $this->user->save();

            $this->successfulPersonCreation = true;
            $this->showCreateForm = false;
            $person->fresh();
            $this->personLink = $person->slug;

        } catch (Throwable $exception) {
            // TODO: Do this
            $this->errorPersonCreation = "Sorry there was an issue creating your person. Please email help@neuly.com and we'll get it sorted.";

        }
    }

    public function render()
    {
        return view('livewire.members.settings.find-or-create-person-listing');
    }
}
