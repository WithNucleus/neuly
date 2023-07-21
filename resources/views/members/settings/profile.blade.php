@extends('layouts.app')

@section('body-class', 'page-user-settings bg-body-secondary')

@section('content')
    @include('navbars.primary')

    <x-members.settings title="Account Settings">
        <livewire:members.settings.profile :user="$user" />
    </x-members.settings>
@endsection
