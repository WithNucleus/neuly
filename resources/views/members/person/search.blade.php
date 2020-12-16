@extends('layouts.app')

@section('body-class', 'page-user-settings bg-light')

@section('content')

    @include('navbars.primary')

    <div class="container">
        <main id="content-main" role="main" class="col-12">
            <div class="row">
                <div class="col-12 col-xl-10 mx-auto bg-white p-4 shadow-sm">

                    <h1 class="page-title-default text-primary mb-4">Find your person profile</h1>

                    <div class="py-4 col-12 col-lg-12">

                        <div class="alert alert-danger errors alert-dismissible fade show" style="display:none">
                            <ul class="plain-list mb-0 font-small"></ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        @include('members.includes.status-messages')

                        <form id="person-search" action="{{ route('user.person.search') }}" method="get" class="mb-4 form-inline ml-auto needs-validation" novalidate>
                            <div class="md-form my-0  ml-sm-10">
                                <input name="search" class="form-control" type="text" placeholder="Search" aria-label="Search" value="{{ $cleanTerm }}">
                            </div>
                            <button href="#!" class="btn btn-primary btn-md my-0 ml-sm-2" type="submit">Search</button>
                        </form>

                        @if ($people->count() > 0)

                        {{-- People --}}
                        <ul class="list-group list-group-flush mb-4 shadow-sm">
                            @forelse($people as $person)
                                <li class="list-group-item p-4 d-md-flex">

                                    <div class="image mr-3">
                                        @if($person->photo != '')
                                            <div class="person-photo-small shadow-sm" style="background-image: url('/storage/{{ $person->photo }}');">
                                                <span class="sr-only">{{ $person->name }}</span>
                                            </div>
                                        @else
                                            <img src="{{ asset('images/person-blank.png') }}" class="person-photo-small shadow-sm" alt="{{ $person->name }}">
                                        @endif
                                    </div>

                                    <div class="text">
                                        <p class="lead-smaller mb-1 mt-1">
                                            <a href="{{ route('discover.people.show', $person->slug) }}">{{ $person->name }}</a>
                                        </p>

                                        @if($person->locations->count() > 0)
                                            <p class="mb-1 truncate-this-xl">
                                                <span class="text-info"><i class="fad fa-globe-stand"></i></span>
                                                @foreach ($person->locations as $location)
                                                {{ $location->name }}@if (!$loop->last) &bull; @endif
                                                @endforeach
                                            </p>
                                        @endif

                                        @if($person->companies->count() > 0)
                                            <p class="mb-1 truncate-this-xl">
                                                <span class="text-quaternary"><i class="fad fa-briefcase"></i></span>
                                                @foreach ($person->companies as $company)
                                                {{ $company->name }}@if (!$loop->last) &bull; @endif
                                                @endforeach
                                            </p>
                                        @endif

                                        @if($person->research->count() > 0)
                                            <p class="mb-1 truncate-this-xl">
                                                <span class="text-primary"><i class="fad fa-microscope"></i></span>
                                                @foreach ($person->research as $article)
                                                {{ $article->name }}@if (!$loop->last) &bull; @endif
                                                @endforeach
                                            </p>
                                        @endif

                                        @if($person->investors->count() > 0)
                                            <p class="mb-1 truncate-this-xl">
                                                <span class="text-danger"><i class="fad fa-hands-usd"></i></span>
                                                @foreach ($person->investors as $investor)
                                                {{ $investor->name }}@if (!$loop->last) &bull; @endif
                                                @endforeach
                                            </p>
                                        @endif

                                    </div>

                                </li>

                            @empty
                                <li class="list-group-item">
                                    <p class="lead mb-0">
                                        No people match your search criteria.
                                    </p>
                                </li>
                            @endforelse
                        </ul>

                        @else
                            We coundn't find a matching person, please have a look at our <a href="{{ route('discover.people') }}">person section</a>.
                        @endif
                    </div>

                </div>
            </div>
        </main>
    </div>

    @include('footers.mini')

@endsection
