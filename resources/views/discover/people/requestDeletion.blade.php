@extends('layouts.app')

@section('content')
    @include('navbars.primary')

    <div class="container py-5 text-center">
        @include('discover.includes.status-messages')

        <h1 class="text-success">Request Deletion for</h1>
        <h2 class="text-body-emphasis">{{ $person->name }}</h2>

        <div class="max-width-500 mx-auto my-4 text-start">
            <form method="post" action="{{ route('discover.people.requestDeletion', $person->slug) }}" style="max-width: 600px;" class="mx-auto">
                @csrf

                @auth
                    <input type="hidden" name="name" value="{{ Auth::user()->name . ' ' . Auth::user()->last_name }}">
                    <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                @else
                    <div class="mb-3">
                        <label class="fw-bold text-uppercase" for="name">Name <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="name" id="name" required>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold text-uppercase" for="email">Email <span class="text-danger">*</span></label>
                        <input class="form-control" type="email" name="email" id="email" required>
                    </div>
                @endauth

                <div class="mb-3">
                    <label class="fw-bold text-uppercase">Why do you want to delete this record? <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="cause" required rows="4"></textarea>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary rounded-0">Send</button>
                    <a class="btn" href="{{ route('discover.people.show', $person->slug) }}">Cancel</a>
                </div>
            </form>
        </div>

        @include('footers.full')
    </div>
@endsection
