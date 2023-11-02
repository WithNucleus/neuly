<div>
    @if($error)
        <div class="fs-6 text-danger">
            {{ $error }}
        </div>
    @else
        @if($success)
            <div>
                <p class="fs-5 text-success">Your account's been created! Now you can start exploring.</p>
                <div class="mt-4">
                    <a href="{{ $dashboardLink }}" class="btn btn-primary btn-lg btn-cta">Go to Your Dashboard</a>
                </div>
            </div>
        @else
            <div class="max-width-600 mx-auto">
                <p class="fs-6">You're almost there! Fill out your profile to get direct access to all of our psychedelics research and more.</p>
                <form wire:submit.prevent="submit" class="text-start">
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label for="first_name" class="text-primary fw-bold text-uppercase">First Name</label>
                            <input wire:model="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name">
                            @error('first_name') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="last_name" class="text-primary fw-bold text-uppercase">Last Name</label>
                            <input wire:model="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name">
                            @error('last_name') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="email" class="text-primary fw-bold text-uppercase">Email</label>
                            <input wire:model="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email">
                            @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="password" class="text-primary fw-bold text-uppercase">Password</label>
                            <input wire:model="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="************">
                            @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <div class="d-flex">
                                <label for="interests" class="text-primary fw-bold text-uppercase">What are you interested in?</label>
                            </div>

                            <div class="row">
                                @foreach($interestedInOptions as $optionValue => $optionMessage)
                                    <div class="col-12 col-lg-6 my-1">
                                        <div class="form-check">
                                            <input wire:model="interests" class="form-check-input" type="checkbox" value="{{ $optionValue }}" id="interested-in-{{ $optionValue }}">
                                            <label class="form-check-label" for="interested-in-{{ $optionValue }}">
                                                <span class="text-uppercase fw-bold d-block">{{ $optionValue }}</span>
                                                <span class="small text-body-secondary">{{ $optionMessage }}</span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary rounded-0">Save</button>
                    </div>
                </form>
            </div>
        @endif
    @endif
</div>
