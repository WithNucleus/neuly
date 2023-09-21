<div>
    @if($success)
        <div class="text-primary fs-6 fw-bold">
            Thanks for your interest in NeulyEDU! We'll be in touch soon.
        </div>
    @else
        <div>
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
                </div>
                <div class="mb-3">
                    <label for="message" class="fw-bold text-uppercase">Anything you'd like us to know or pass along?</label>
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
