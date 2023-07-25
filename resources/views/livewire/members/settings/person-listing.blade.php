<div>
    <div>
        @include('discover.people.data')
    </div>
    <div class="my-5 border-top border-bottom py-5">
        <h2 class="h3 text-primary-emphasis">Update Your Public Listing</h2>
        <form wire:submit.prevent="submit" enctype="multipart/form-data">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label class="fw-bold" for="byline">Byline</label>
                        <input wire:model="person.byline" type="text" class="form-control" id="byline">
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold" for="website">Website</label>
                        <input wire:model="person.website" type="url" class="form-control" id="website">
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold" for="bio">Bio</label>
                        <textarea wire:model.lazy="person.bio" id="bio" rows="4" class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label class="fw-bold" for="facebook">Facebook</label>
                        <div class="input-group">
                            <span class="input-group-text">https://www.facebook.com/</span>
                            <input wire:model="person.facebook" type="text" class="form-control" id="facebook">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold" for="instagram">Instagram</label>
                        <div class="input-group">
                            <span class="input-group-text">https://www.instagram.com/</span>
                            <input wire:model="person.instagram" type="text" class="form-control" id="instagram">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold" for="twitter">Twitter</label>
                        <div class="input-group">
                            <span class="input-group-text">https://www.twitter.com/</span>
                            <input wire:model="person.twitter" type="text" class="form-control" id="twitter">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold" for="google-scholar">Google Scholar</label>
                        <input wire:model="person.google_scholar" type="url" class="form-control" id="google-scholar">
                    </div>
                </div>
            </div>
            <div class="mt-2">
                <label class="fw-bold" for="photo">Photo</label>
                <input type="file" id="photo" wire:model.debounce.500ms="photo" class="form-control max-width-500 me-3">
                <p class="m-0 text-small fst-italic">Images only, square works best. 1024 KB max</p>
                @error('photo') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <div class="mt-3 d-flex flex-wrap align-items-center">
                <div class="me-3">
                    <button class="btn btn-lg btn-primary">Save</button>
                </div>
                @if($success)
                    <div class="text-accent">Updated!</div>
                @endif
                @if($error)
                    <div class="text-accent">There was an error. Try again or contact help@neuly.com if it keeps happening</div>
                @endif
            </div>
        </form>
    </div>
    <div class="my-5 border-bottom pb-5">
        <h3 class="text-primary-emphasis">Control your connections on Neuly</h3>
        <div class="row">
            <div class="col-12 col-md-6">
                <h4 class="h5">Focus</h4>

                <div class="my-3 d-flex">
                    <input wire:model="searchFocus" type="text" class="form-control form-control-lg rounded-0" aria-label="Search to add focus" placeholder="Search to add focus">
                    @if($searchFocus)
                        <button wire:click="clearSearch('focus')" class="btn text-danger rounded-0 ms-2" aria-label="Clear search"><i class="fa-sharp fa-solid fa-xmark-large"></i></button>
                    @endif
                </div>

                <ul class="list-group rounded-0">
                    @foreach($resultsFocus as $key => $focus)
                        <li class="list-group-item d-flex align-items-center justify-content-between">
                            <span>{{ $focus }}</span>
                            <button wire:click="addFocus('{{ $key }}')" class="btn btn-sm btn-accent">Add</button>
                        </li>
                    @endforeach
                </ul>

                <ul class="list-group list rounded-0 my-3">
                    @forelse($person->focus as $focus)
                        <li wire:key="focus-{{ $focus->id }}" wire:poll.visible class="list-group-item d-flex align-items-center justify-content-between">
                            <span>{{ $focus->name }}</span>
                            <button wire:click="removeFocus('{{ $focus->id }}')" class="btn btn-sm btn-danger">Remove</button>
                        </li>
                    @empty
                        <li wire:poll.visible class="list-group-item">None yet</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
