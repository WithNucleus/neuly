@extends('layouts.app')

@section('body-class', 'page-user-settings bg-body-secondary')

@section('content')
    @include('navbars.primary')

    <x-members.settings title="Account Settings">

        <div class="text-center">
            <h2 class="text-center">Verify Your New Email</h2>

            <p>We sent verification link to your new email address.</p>
            <p>Thanks for using Neuly!</p>

            <p class="mt-4 mb-0"><a href="/">Back to Neuly</a></p>
        </div>

    </x-members.settings>

    @include('footers.mini')

@endsection
