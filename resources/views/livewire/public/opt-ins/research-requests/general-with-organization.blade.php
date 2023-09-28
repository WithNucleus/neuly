<div>
    @if($success)
        <div class="text-center">
            <div class="text-accent mb-2 fs-5 fw-bold">
                Thanks for your interest in NeulyRESEARCH!
            </div>
            <div class="fs-6">
                We'll be in touch soon.
            </div>
            @if($showSuccessActions)
                <div class="mt-5 d-flex align-items-center justify-content-center">
                    <div class="me-3">
                        @auth
                            <a href="{{ Auth::user()->dashboard_link }}" class="btn btn-primary btn-lg btn-cta">Go to Your Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg btn-cta">Login to Neuly</a>
                        @endauth
                    </div>
                    <div>
                        <a href="/" class="btn btn-lg">Back Home</a>
                    </div>
                </div>
            @endif
        </div>
    @else
        <div>
            @if($titleMessage)
                <p class="{{ $titleClasses ?? 'fs-6 text-center' }}">{{ $titleMessage }}</p>
            @endif
            <form wire:submit.prevent="submit">
                <div class="row">
                    <div class="col-12 col-md-6 mb-3">
                        <label for="first_name" class="fw-bold text-uppercase">First name</label>
                        <input wire:model="first_name" type="text" class="form-control" id="first_name">
                        @error('first_name') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label for="last_name" class="fw-bold text-uppercase">Last name</label>
                        <input wire:model="last_name" type="text" class="form-control" id="last_name">
                        @error('last_name') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label for="email" class="fw-bold text-uppercase">Email</label>
                        <input wire:model="email" type="email" class="form-control" id="email">
                        @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label for="phone" class="fw-bold text-uppercase">Phone</label>
                        <input wire:model="phone" type="text" class="form-control" id="email">
                        @error('phone') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label for="organization" class="fw-bold text-uppercase">Organization</label>
                        <input wire:model="organization" type="text" class="form-control" id="organization">
                        @error('organization') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label for="website" class="fw-bold text-uppercase">Website</label>
                        <input wire:model="website" type="url" class="form-control" id="website" placeholder="https://website.com">
                        @error('website') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="message" class="fw-bold text-uppercase">{{ $messageLabel ?? 'Tell us the details' }}</label>
                    <textarea wire:model="message" name="message" id="message" rows="4" class="form-control"></textarea>
                    @error('message') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>
                <div>
                    <button type="submit" class="btn btn-accent">Send</button>
                </div>
            </form>
        </div>
    @endif
</div>
