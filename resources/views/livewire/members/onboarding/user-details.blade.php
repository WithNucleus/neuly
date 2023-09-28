<div>
    @if($success)
        <div>
            <p class="fs-5 text-success">Your account's been created! Now you can start exploring.</p>
            <div class="mt-4">
                <a href="{{ Auth::user()->dashboard_link }}" class="btn btn-primary btn-lg btn-cta">Go to Your Dashboard</a>
            </div>
        </div>
    @else
        <div>
            <p class="fs-5 text-success">Welcome to Neuly! Fill out your details below:</p>
            <form wire:submit.prevent="submit" class="text-start max-width-600 mx-auto">
                <div class="row">
                    <div class="col-12 col-md-6 mb-3">
                        <label for="first_name" class="text-primary fw-bold text-uppercase">First Name</label>
                        <input wire:model="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name">
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label for="last_name" class="text-primary fw-bold text-uppercase">Last Name</label>
                        <input wire:model="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name">
                    </div>
                    <div class="col-12 mb-3">
                        <label for="password" class="text-primary fw-bold text-uppercase">Password</label>
                        <input wire:model="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="************">
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label for="referred_by" class="text-primary fw-bold text-uppercase">How did you hear about us?</label>
                        <select wire:model="referred_by" id="referred_by" class="form-select @error('referred_by') is-invalid @enderror">
                            <option value="">-</option>
                            @foreach($referralOptions as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($referred_by === 'Other')
                        <div class="col-12 col-md-6 mb-3">
                            <label for="referred_by_other" class="text-primary fw-bold text-uppercase">Please tell us</label>
                           <input wire:model="referred_by_other" type="text" class="form-control" id="referred_by_other">
                        </div>
                    @endif
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
                    <div class="col-12 col-md-6 mb-3">
                        <label for="registration_code" class="text-primary fw-bold text-uppercase">Promo / Registration Code</label>
                       <input wire:model="registration_code" type="text" class="form-control" id="referred_by_other">
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary rounded-0">Save</button>
                </div>
            </form>
        </div>
    @endif
</div>
