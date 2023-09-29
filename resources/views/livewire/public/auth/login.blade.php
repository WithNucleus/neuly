<div>
    @if($message)
        <div class="mb-1 text-accent fs-6">{{ $message }}</div>
    @endif
    @if($showForm)
        <div>
            @if($success)
                <div>
                    <div class="text-accent fs-6">{{ $success }}</div>
                    <div class="mt-2">
                        <a href="{{ Auth::user()->dashboard_link }}" class="ms-0 btn btn-primary btn-lg btn-cta">Go to Your Dashboard</a>
                    </div>
                </div>
            @else
                <form wire:submit.prevent="submit">
                    <div class="d-md-flex justify-content-center">
                        @if($showEmail)
                            <div class="mb-3 mb-md-0 me-md-3 flex-grow-1">
                                <input wire:model="email" type="email" class="form-control" id="email" aria-label="Email" placeholder="Email">
                                @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                        @endif
                        <div class="d-flex mb-3 mb-md-0 me-md-3 flex-grow-1">
                            <input wire:model="password" type="password" class="form-control" id="password" aria-label="Password" placeholder="Password">
                            <button type="submit" class="btn btn-accent text-nowrap">Login to Neuly</button>
                        </div>
                        <div>
                            @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </form>
                @if($error)
                    <div class="text-danger">{{ $error }}</div>
                @endif
            @endif
        </div>
    @endif
</div>
