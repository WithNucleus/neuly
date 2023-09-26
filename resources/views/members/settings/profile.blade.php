@extends('layouts.app')

@section('body-class', 'page-user-settings bg-body-secondary')

@section('content')
    @include('navbars.primary')

    <x-members.settings title="Account Settings">
        <livewire:members.settings.profile :user="$user" />
        <!-- TODO Add Person Listing stuff to this page I think?? -->

        <div class="mt-5">
            <h2 class="h4">Neuly Person Listing</h2>
            @include('members.settings._related-person')
        </div>
    </x-members.settings>
@endsection
