<div>
    @if($successfulPersonCreation)
        <div class="my-3">
            <div class="h5 mb-3 text-accent">Success! Your person listing has been created!</div>
            <a href="/person/{{ $personLink }}" class="btn btn-lg btn-primary">View Person Listing</a>
        </div>
    @elseif($successfulPersonClaimed)
        <div class="my-3">
            <div class="h5 mb-3 text-accent">Success! Your person listing has been claimed!</div>
            <a href="{{ $personLink }}" class="btn btn-lg btn-primary">View Person Listing</a>
        </div>
    @elseif($manualClaimSent)
        <div class="my-3 text-accent">
            {{ $manualClaimSent }}
        </div>
    @else
        <div>
            @if($showCreateForm)
                <form wire:submit.prevent="submit">
                    <div class="row">
                        @if($errorPersonCreation)
                            <div class="col-12 col-md-6 col-lg-8 offset-md-6 offset-lg-4 text-danger mb-2">
                                {{ $errorPersonCreation }}
                            </div>
                        @endif
                        <div class="col-12 col-md-6 col-lg-8 offset-md-6 offset-lg-4 h5 text-accent fw-bold">Create a New Person</div>
                        <x-forms.input-label id="name" name="Name" />
                        <x-forms.input-field id="name" name="Name" placeholder="Full name" type="text" />

                        <x-forms.input-label id="email" name="Email" />
                        <x-forms.input-field id="email" name="Email" placeholder="you@email.com" type="email" />

                        <x-forms.input-label id="byline" name="Byline" />
                        <x-forms.input-field id="byline" name="Byline" type="text" />

                        <x-forms.input-label id="website" name="Website" />
                        <x-forms.input-field id="website" name="Website" placeholder="https://" type="url" />
                        <div class="col-12 col-md-6 col-lg-8 offset-md-6 offset-lg-4">
                            <button type="submit" class="btn btn-lg btn-accent">Save</button>
                        </div>
                    </div>
                </form>
            @else
                <div class="mb-3">Complete your profile and get listed on Neuly. Search your name below and if you're already listed, we'll get you verified.</div>
                <div class="my-3">
                    <input wire:model="personSearch" class="form-control" placeholder="Your name" aria-label="Your name">
                </div>
                @if($personSearch)
                    @if($personResults)
                        <ul class="list-group list-group-flush">
                            @foreach($personResults as $person)
                                <li wire:key="person-{{ $person['slug'] }}" class="list-group-item">
                                    @if($person['id'] === $selectedPersonId)
                                        <button class="btn text-accent"
                                                aria-label="Select {{ $person['name'] }}" tabindex="0">
                                            <i class="fa-sharp fa-regular fa-square-check me-1"></i>
                                            <span>{{ $person['name'] }}</span>
                                        </button>
                                    @else
                                        <button wire:click="selectPerson('{{ $person['id'] }}')"
                                                class="btn" aria-label="Select {{ $person['name'] }}" tabindex="0">
                                            <i class="fa-sharp fa-regular fa-square me-1"></i>
                                            <span>{{ $person['name'] }}</span>
                                        </button>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                        @if($selectedPersonId)
                            <div class="mt-3">
                                <button wire:click="claimExistingPerson" class="btn btn-lg btn-primary">This is me, I want to claim this profile.</button>
                            </div>
                      @endif
                        <div class="mt-4 border-top pt-4">
                            <div class="mb-1">Don't see a match?</div>
                            <button wire:click="createNewPerson" class="btn btn-accent">Let's create a new person</button>
                        </div>
                    @else
                        <div class="mt-3">
                            <div class="mb-3 text-danger">No matches for your name typed above.</div>
                            <button wire:click="createNewPerson" class="btn btn-primary">Let's create a new person</button>
                        </div>
                    @endif
                @endif
            @endif
        </div>
    @endif
</div>
