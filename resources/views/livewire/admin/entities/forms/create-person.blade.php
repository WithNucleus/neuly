<div>
    @if($success)
        <div class="text-accent fs-5">
            Successfully created!
        </div>
    @else
        <form wire:submit.prevent="submit">
            <div class="row">
                <div class="col-12 col-lg-6 mb-3">
                    <label class="fw-bold text-uppercase" for="name">Name</label>
                    <input wire:model="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name">
                </div>
                <div class="col-12 col-lg-6 mb-3">
                    <label class="fw-bold text-uppercase" for="email">Email</label>
                    <input wire:model="email" type="text" class="form-control @error('email') is-invalid @enderror" id="email">
                </div>
                <div class="col-12 col-lg-6 mb-3">
                    @if($company)
                        <div>
                            <label for="company" class="fw-bold text-uppercase">Company</label>
                            <input wire:model="company" type="text" class="form-control @error('company') is-invalid @else is-valid @enderror" id="company">
                        </div>
                    @else
                        <div>
                            <div>
                                <label for="company_search" class="fw-bold text-uppercase">Company</label>
                                <input wire:model="company_search" type="text" class="form-control @error('company') is-invalid @enderror" id="company_search">
                            </div>
                            @if($this->company_search)
                                <div class="faux-search-box-container">
                                    <div class="faux-search-box-results">
                                        <ul class="list-group list-group-flush">
                                            @forelse($this->companySearchResults as $result)
                                                <li class="list-group-item list-group-item-action p-0">
                                                    <button wire:click="assignCompany('{{ $result['id'] }}')" class="btn text-start w-100 fw-normal rounded-0">
                                                        {{ $result['name'] }}
                                                    </button>
                                                </li>
                                            @empty
                                                <li class="list-group-item">
                                                    No matches for your search
                                                </li>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="col-12 col-lg-6 mb-3">
                    <label class="fw-bold text-uppercase" for="company_role">Company Role / Position</label>
                    <input wire:model="company_role" type="text" class="form-control @error('company_role') is-invalid @enderror" id="company_role">
                </div>
                <div class="col-12 col-lg-6 mb-3">
                    <label class="fw-bold text-uppercase" for="website">Website</label>
                    <input wire:model="website" type="text" class="form-control @error('website') is-invalid @enderror" id="website">
                </div>
                <div class="col-12 col-lg-6 mb-3">
                    <label class="fw-bold text-uppercase" for="byline">Byline</label>
                    <input wire:model="byline" type="text" class="form-control @error('byline') is-invalid @enderror" id="byline">
                </div>
                <div class="col-12 mb-3">
                    <label class="fw-bold text-uppercase" for="bio">Bio</label>
                    <textarea wire:model="bio" name="bio" id="bio" rows="4" class="form-control @error('bio') is-invalid @enderror"></textarea>
                </div>
                <div class="col-12 col-lg-6 mb-3">
                    <label class="fw-bold text-uppercase" for="facebook">Facebook</label>
                    <div class="input-group">
                        <span class="input-group-text">https://www.facebook.com/</span>
                        <input wire:model="facebook" type="text" class="form-control @error('facebook') is-invalid @enderror" id="facebook">
                    </div>
                </div>
                <div class="col-12 col-lg-6 mb-3">
                    <label class="fw-bold text-uppercase" for="instagram">Instagram</label>
                    <div class="input-group">
                        <span class="input-group-text">https://www.instagram.com/</span>
                        <input wire:model="instagram" type="text" class="form-control @error('instagram') is-invalid @enderror" id="instagram">
                    </div>
                </div>
                <div class="col-12 col-lg-6 mb-3">
                    <label class="fw-bold text-uppercase" for="linkedin">LinkedIn</label>
                    <div class="input-group">
                        <span class="input-group-text">https://www.linkedin.com/in/</span>
                        <input wire:model="linkedin" type="text" class="form-control @error('linkedin') is-invalid @enderror" id="linkedin">
                    </div>
                </div>
                <div class="col-12 col-lg-6 mb-3">
                    <label class="fw-bold text-uppercase" for="google_scholar">Google Scholar</label>
                    <input wire:model="google_scholar" type="text" class="form-control @error('google_scholar') is-invalid @enderror" id="google_scholar">
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    @endif
</div>
