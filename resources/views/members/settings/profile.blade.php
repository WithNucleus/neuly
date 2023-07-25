@extends('layouts.app')

@section('body-class', 'page-user-settings bg-body-secondary')

@section('content')
    @include('navbars.primary')

    <x-members.settings title="Account Settings">
        <livewire:members.settings.profile :user="$user" />
        <!-- TODO Add Person Listing stuff to this page I think?? -->

        <div class="mt-5">
            <h2 class="h4">Neuly Person Listing</h2>
            @if($user->relatedPerson)
                <div class="d-flex align-items-center flex-wrap">
                    <div class="flex-shrink-0 me-3">
                        <div style="width: 150px" class="text-center">
                            <div class="logo-square-is-contained rounded-circle mb-1" style="background-image: url('{{ $user->relatedPerson->entityImageUrl ?? asset('images/person-blank.png') }}');"></div>
                        </div>
                    </div>
                    <div>
                        <div class="me-3">
                            <span class="me-2">{{ $user->relatedPerson->name }}</span>
                            <span class="badge bg-accent">Verified</span>
                        </div>
                        <div class="mt-2">
                            <a href="{{ route('discover.people.show', $user->relatedPerson->slug) }}">{{ route('discover.people.show', $user->relatedPerson->slug) }}</a>
                        </div>
                    </div>
                </div>
            @else
                <livewire:members.settings.find-or-create-person-listing :user="$user" />
            @endif
        </div>
    </x-members.settings>
@endsection
