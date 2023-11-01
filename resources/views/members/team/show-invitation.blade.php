@extends('layouts.app')

@section('content')

    @include('navbars.primary')

    <div class="container my-5">
        <div class="max-width-780 bg-body-secondary mx-auto text-center p-5">
            <h1 class="text-primary">You're invited to join</h1>
            <h2>{{ $team->name }}</h2>

            <form method="post" action="{{ route('invitation.accept-team-invite') }}">
                @csrf
                <input type="hidden" name="team_id" value="{{ $team->id }}">
                <input type="hidden" name="user_id" value="{{ $userId }}">
                <input type="hidden" name="invitation_id" value="{{ $invitationId }}">

                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-accent rounded-0 btn-lg">Accept</button>
                    <a href="{{ route('index') }}" class="btn rounded-0 btn-lg">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    @include('footers.mini')

@endsection
