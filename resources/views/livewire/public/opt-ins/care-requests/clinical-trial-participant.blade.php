<div>
    @if($success)
        <div class="text-center">
            <div class="text-accent mb-2 fs-5 fw-bold">
                Thanks for your interest in NeulyCARE!
            </div>
            <div class="fs-6">
                We'll be in touch soon.
            </div>
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
                    <div class="col-12 col-md-6 mb-3">
                        <label for="age" class="fw-bold text-uppercase">Age</label>
                        <input wire:model="age" type="number" class="form-control" id="age" step="1">
                        @error('age') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label for="sex" class="fw-bold text-uppercase">Sex</label>
                        <select wire:model="sex" id="sex" class="form-select">
                            <option value=""></option>
                            @foreach($sexOptions as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </select>
                        @error('sex') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="message" class="fw-bold text-uppercase">Anything we should know?</label>
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
