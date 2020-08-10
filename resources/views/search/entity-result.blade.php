@extends('layouts.app')

@section('body-class', 'page-search-results bg-light')

@section('content')

    @include('navbars.primary')

    <main id="content-main" role="main" class="col-lg-9 col-xl-10 mx-auto">
        <div class="row">
            <div class="col-12">
                <h1>You are searching {{ $type }} for "{{ $term }}"</h1>
                <p>
                    <small>
                        <a href="/search/{{ $term }}"><span class="text-tertiary">&larr;</span> Back to Search Results</a>
                    </small>
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        @if(count($result) > 0)
                            <ul class="list-group list-group-flush">
                                @foreach($result as $item)
                                    @if($type === 'Jobs')
                                    <li class="list-group-item"><a href="{{ route($route, ['slug' => $item->slug]) }}">{{ $item->job_title }}</a></li>
                                    @else
                                    <li class="list-group-item"><a href="{{ route($route, ['slug' => $item->slug]) }}">{{ $item->name }}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        @else
                            No matching entry found.
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @include('footers.mini')

    </main>

@endsection