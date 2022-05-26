<div class="bookable-form-container shadow-sm">
    <h2 class="h4 text-primary mb-3">Book with {{ $bookableListing->bookable->name }}</h2>
    <div class="text-left">
        @include('discover.includes.status-messages')
    </div>
    <form action="{{ route('discover.bookable-listing.reservation-request') }}" method="post">
        @csrf
        <div class="mb-4 d-flex align-items-center justify-content-center">
            <label for="first_name" class="sr-only">First Name</label>
            <input type="text" name="first_name" id="first_name" class="form-control mr-2" placeholder="First name" value="@auth{{ Auth::user()->name }}@endauth">

            <label for="last_name" class="sr-only">Last Name</label>
            <input type="text" name="last_name" id="last_name" class="form-control ml-2" placeholder="Last name" value="@auth{{ Auth::user()->last_name }}@endauth">
        </div>
        <div class="mb-4 d-flex align-items-center justify-content-center">
            <label for="email" class="sr-only">Email</label>
            <input type="email" name="email" id="email" class="form-control mr-2" placeholder="Email" value="@auth{{ Auth::user()->email }}@endauth">

            <label for="phone" class="sr-only">Last Name</label>
            <input type="tel" name="phone" id="phone" class="form-control ml-2" placeholder="Phone #">
        </div>
        @if($bookableListing->type == \App\Models\BookableListing::TYPE_RETREAT)
            <div class="mb-4 d-flex align-items-center justify-content-center">
                <label for="number_of_guests" class="font-weight-bold d-block mb-0 mr-2 text-nowrap"># of Guests</label>
                <input type="number" name="number_of_guests" id="number_of_guests" class="form-control" value="{{ old('number_of_guests') ?? 1 }}">
            </div>
        @else
            <div class="mb-4 d-flex align-items-center justify-content-center">
                <label for="date" class="font-weight-bold d-block mb-0 mr-2 text-nowrap">Requested Date</label>
                <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
            </div>
        @endif
        <div class="mb-4">
            <label for="message" class="font-weight-bold">Any questions or comments?</label>
            <textarea class="form-control" name="message" id="message" rows="2">{{ old('message') }}</textarea>
        </div>
        <div>
            <input type="hidden" name="bookable_listing_id" value="{{ $bookableListing->id }}">
            <button type="submit" class="btn btn-success" @if($bookableListing->status == \App\Models\BookableListing::STATUS_PENDING) disabled @endif>Send Reservation Request</button>
        </div>
    </form>
</div>
