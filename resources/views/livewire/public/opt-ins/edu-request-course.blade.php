<div>
    @if($success)
        <div class="text-accent fs-6 fw-bold">
            Thanks for your interest in NeulyEDU! We'll be in touch soon.
        </div>
    @else
        <div>
            <form wire:submit.prevent="submit">
                <div class="row">
                    <div class="col-12 col-md-6 mb-3">
                        <label for="name" class="fw-bold text-uppercase">Your name</label>
                        <input wire:model="name" type="text" class="form-control" id="name">
                        @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label for="email" class="fw-bold text-uppercase">Email</label>
                        <input wire:model="email" type="email" class="form-control" id="email">
                        @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
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
