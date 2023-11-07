@extends('layouts.app')

@section('content')

    @include('navbars.primary')

    <div class="container py-5">
        <div class="max-width-780 mx-auto bg-body-secondary p-4 p-lg-5 text-center ">
             <div class="display-1">
                <i class="fa-sharp fa-solid fa-envelope-circle-check text-accent mb-2"></i>
            </div>
            <h1 class="h2 text-transform-none">Thanks for verifying your email!</h1>
            <div>
                <livewire:members.onboarding.user-details :user="$user" />
            </div>
        </div>
    </div>

@endsection
