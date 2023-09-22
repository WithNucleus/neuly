@extends('layouts.app')

@section('content')

    @include('navbars.primary')

    <div class="container text-center py-5">
        <h1 class="text-primary">Request Insight</h1>
        <div>
            <p class="h4 max-width-600 mx-auto my-3">Interested in how certain data types fit together? We can help!</p>
            <p class="fs-6 max-width-600 mx-auto">
                We can combine, correlate, and compare any data set you can think of. Let us know what's valuable to you, and we'll get it done.
            </p>

            @auth
                <form action="{{ route('discover.insights.saveRequest') }}" method="post" class="max-width-600 mx-auto">
                    @csrf
                    <div class="mb-3">
                        <textarea class="form-control" name="text" placeholder="Describe your request" aria-label="Describe your request" rows="8" required></textarea>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary btn-lg">Request Insight</button>
                    </div>
                </form>
            @else
                <p class="lead text-center bg-tertiary p-4 shadow-sm">
                    You must be logged in to request an insight.<br><br>
                    <a href="{{ route('login') }}" class="btn btn-primary">Login to Neuly</a>
                </p>
            @endauth
        </div>
    </div>

    @include('footers.full')
@endsection
