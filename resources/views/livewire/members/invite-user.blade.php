<div>
    <div class="fs-6 text-body-secondary mb-3">
        Invite someone to Neuly so they'll have direct access to all of our psychedelics research, over 3,000 practitioners, and close to 500 educational courses.
    </div>

    @if($error)
        <div class="fs-6 text-primary mb-3">
            {{ $error }}
        </div>
    @endif

    @if($success)
        <div class="fs-6 text-accent mb-3">
            {{ $success }}
        </div>
    @endif

    <form wire:submit.prevent="submit" class="max-width-500">
        <div class="mb-3">
            <input wire:model="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" placeholder="First Name">
        </div>
        <div class="mb-3">
            <input wire:model="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" placeholder="Last Name">
        </div>
        <div class="mb-3">
            <input wire:model="email" type="text" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email">
        </div>
        <div>
            <button type="submit" class="btn btn-primary rounded-0">Send Invitation</button>
        </div>
    </form>
</div>
