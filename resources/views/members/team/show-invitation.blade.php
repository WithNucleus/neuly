@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('navbars.primary')

    <div class="container">
        <main id="show-main" role="main" class="col-12">
            <div class="row">
                <div class="col-12 col-xl-10 mx-auto bg-white p-4 shadow-sm text-center">

                    <h1 class="page-title-default text-primary">You invited to join team "{{ $team->name }}"!</h1>

                    <form method="post" action="{{ route('invitation.accept') }}">
                        @csrf
                        <input type="hidden" name="team_id" value="{{ $team->id }}">
                        <input type="hidden" name="user_id" value="{{ $userId }}">
                        <input type="hidden" name="invitation_id" value="{{ $invitationId }}">

                        <p class="mt-4 text-center">
                            <button type="submit" class="btn btn-success">Accept</button>
                            <a href="{{ route('index') }}" class="btn btn-default">Cancel</a>
                        </p>
                    </form>

                </div>
            </div>

        </main>
    </div>

    @include('footers.mini')

@endsection
