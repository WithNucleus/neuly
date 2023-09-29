<div>
    @if($success)
        <div class="text-primary text-center fs-5 fw-bold">
            Thanks for your interest in NeulyEDU! We'll be in touch soon.
        </div>
    @else
        <div>
            <form wire:submit.prevent="submit">
                <div class="row">
                    <div class="col-12 col-md-6 mb-3">
                        <label for="first_name" class="fw-bold text-uppercase">First name</label>
                        <input wire:model="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name">
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label for="last_name" class="fw-bold text-uppercase">Last name</label>
                        <input wire:model="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name">
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label for="email" class="fw-bold text-uppercase">Email</label>
                        <input wire:model="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email">
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label for="phone" class="fw-bold text-uppercase">Phone</label>
                        <input wire:model="phone" type="text" class="form-control @error('phone') is-invalid @enderror" id="phone">
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label for="zip_code" class="fw-bold text-uppercase">Zip Code</label>
                        <input wire:model="zip_code" type="text" class="form-control @error('zip_code') is-invalid @enderror" id="zip_code">
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label for="budget" class="fw-bold text-uppercase">Budget</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input wire:model="budget" type="number" class="form-control @error('budget') is-invalid @enderror" id="budget" step="1">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="message" class="fw-bold text-uppercase">Anything you'd like us to know or pass along?</label>
                    <textarea wire:model="message" name="message" id="message" rows="4" class="form-control @error('message') is-invalid @enderror"></textarea>
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input wire:model="certifications" class="form-check-input" type="checkbox" value="" id="certifications">
                        <label class="form-check-label" for="certifications">
                            Interested in certifications / continuing education?
                        </label>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-accent">Send</button>
                </div>
            </form>
        </div>
    @endif
</div>
