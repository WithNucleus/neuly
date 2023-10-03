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
                    <label class="fw-bold text-uppercase" for="website">Website</label>
                    <input wire:model="website" type="text" class="form-control @error('website') is-invalid @enderror" id="website">
                </div>
                <div class="col-12 col-lg-6 mb-3">
                    <label class="fw-bold text-uppercase" for="ownership">Ownership</label>
                    <select wire:model="ownership" id="ownership" class="form-select @error('ownership') is-invalid @enderror">
                        <option value=""></option>
                        @foreach($ownershipOptions as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-lg-6 mb-3">
                    <label class="fw-bold text-uppercase" for="ticker_symbol">Ticker Symbol</label>
                    <input wire:model="ticker_symbol" type="text" class="form-control @error('ticker_symbol') is-invalid @enderror" id="ticker_symbol">
                </div>
                <div class="col-12 mb-3">
                    <label class="fw-bold text-uppercase" for="bio">Summary</label>
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
                <div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    @endif
</div>
