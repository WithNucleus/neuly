<div>
    @if($success)
        <div class="text-success fw-bold fs-6">
            Thanks for your message! We'll get back to you soon.
        </div>
    @else
        <form wire:submit.prevent="submit" class="pb-3">
            <div class="row">
                <div class="col-12 col-lg-6 mb-3">
                    <div class="form-floating">
                        <input type="text" wire:model="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror" aria-label="First name" placeholder="First name">
                        <label for="first_name">First name</label>
                    </div>
                    @error('first_name') <div class="small text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="col-12 col-lg-6 mb-3">
                    <div class="form-floating">
                        <input type="text" wire:model="last_name" id="last_name" class="form-control @error('last_name') is-invalid @enderror" aria-label="Last name" placeholder="Last name">
                        <label for="last_name">Last name</label>
                    </div>
                    @error('last_name') <div class="small text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="col-12 col-lg-6 mb-3">
                    <div class="form-floating">
                        <input type="email" wire:model="email" id="email" class="form-control @error('email') is-invalid @enderror" aria-label="Email" placeholder="Email">
                        <label for="email">Email</label>
                    </div>
                    @error('email') <div class="small text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="col-12 col-lg-6 mb-3">
                    <div class="form-floating">
                        <input type="text" wire:model="phone" id=phone" class="form-control @error('phone') is-invalid @enderror" aria-label="Phone" placeholder="Phone (optional)">
                        <label for="phone">Phone (optional)</label>
                    </div>
                    @error('phone') <div class="small text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="col-12 col-lg-6 mb-3">
                    <div class="form-floating">
                        <select wire:model="type" id="type" class="form-select @error('type') is-invalid @enderror">
                            @foreach($typeOptions as $type => $label)
                                <option value="{{ $type }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        <label for="type">Type</label>
                    </div>
                    @error('type') <div class="small text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="col-12 col-lg-6 mb-3">
                    <div class="form-floating">
                        <input type="text" wire:model="subject" id="subject" class="form-control @error('subject') is-invalid @enderror" aria-label="Subject" placeholder="Subject">
                        <label for="subject">Subject</label>
                    </div>
                    @error('subject') <div class="small text-danger">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="mb-3">
                <div class="form-floating">
                    <textarea wire:model="message" class="form-control @error('message') is-invalid @enderror" placeholder="Message" id="message" style="min-height: 100px"></textarea>
                    <label for="message">Your Message</label>
                </div>
                @error('message') <div class="small text-danger">{{ $message }}</div> @enderror
            </div>
            <div>
                <button type="submit" class="btn btn-primary rounded-0">Send</button>
            </div>
        </form>
    @endif
</div>
