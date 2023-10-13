<div class="bookable-form-container bg-body-secondary">
    <h2 class="h3 text-success mb-3">Book with {{ $bookableListing->bookable->name }}</h2>
    @if($success)
        <div class="fs-5 text-primary">Your request was sent successfully!</div>
    @else
        <form wire:submit.prevent="submit" class="px-lg-2">
            <div class="row">
                <div class="col-12 col-md-6 mb-4">
                    <label for="first_name" class="sr-only">First Name</label>
                    <input wire:model="first_name" type="text" name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror" placeholder="First name">
                </div>
                <div class="col-12 col-md-6 mb-4">
                    <label for="last_name" class="sr-only">Last Name</label>
                    <input wire:model="last_name" type="text" name="last_name" id="last_name" class="form-control @error('last_name') is-invalid @enderror" placeholder="Last name">
                </div>

                <div class="col-12 col-md-6 mb-4">
                    <label for="email" class="sr-only">Email</label>
                <input wire:model="email" type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                </div>

                <div class="col-12 col-md-6 mb-4">
                    <label for="phone" class="sr-only">Last Name</label>
                    <input wire:model="phone" type="tel" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone #">
                </div>
            </div>
            @if($bookableListing->type == \App\Models\BookableListing::TYPE_RETREAT)
                <div class="mb-4 d-flex align-items-center justify-content-center">
                    <label for="number_of_guests" class="font-weight-bold d-block mb-0 me-2 text-nowrap"># of Guests</label>
                    <input wire:model="number_of_guests" type="number" name="number_of_guests" id="number_of_guests" class="form-control @error('number_of_guests') is-invalid @enderror">
                </div>
            @else
                <div class="mb-4 d-flex align-items-center justify-content-center">
                    <label for="date" class="font-weight-bold d-block mb-0 me-2 text-nowrap">Requested Date</label>
                    <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                </div>
            @endif
            <div class="mb-4">
                <label for="message" class="font-weight-bold">Any questions or comments?</label>
                <textarea wire:model="message" class="form-control @error('message') is-invalid @enderror" name="message" id="message" rows="2"></textarea>
            </div>
            <div>
                <button type="submit" class="btn btn-accent" @if($bookableListing->status == \App\Models\BookableListing::STATUS_PENDING) disabled @endif>Send Reservation Request</button>
            </div>
        </form>
    @endif
</div>
