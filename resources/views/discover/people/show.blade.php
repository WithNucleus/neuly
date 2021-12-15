@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('discover.includes.show-begin', ['full_width' => false])

    <div class="dashboard-actions-container m-2 float-right">
        @include('members.follow.button', [
            'followable_type' => get_class($person),
            'followable_id' => $person->id,
            'name' => $person->name
        ])

        @if($isVerified)
            <span class="badge badge-success">verified</span>
        @elseif(Auth::check() && Auth::user()->hasRaisedClaimBefore() === false)
            @if($person->email)
                <div class="d-inline-block">
                    <form method="post" action="{{ route('discover.people.claim', ['slug' => $person->slug]) }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">Claim this person?</button>
                    </form>
                </div>
            @else
            <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#claimPersonModal">Claim this person?</a>

            <div class="modal fade" id="claimPersonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="post" action="{{ route('discover.people.claim', ['slug' => $person->slug]) }}">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Claim person</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="font-weight-bold">Please tell us, why you want to claim this person?</label>
                                    <textarea class="form-control" name="comment" rows="6" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif
        @endif
    </div>

    <h1>{{ $person->name }}</h1>

    @include('discover.includes.status-messages')

    @include('discover.people.data')

    @isset($preview)
        @include('discover.includes.update-listing-form', ['entity' => $person])
    @else
        @auth
            <div class="row">
                <div class="col-sm-6">
                    <small>Last updated: {{ Carbon\Carbon::parse($person->updated_at)->format('M d, Y') }}</small>
                </div>
                <div class="col-sm-6 text-right">
                    @include('discover.includes.update-listing-form', ['entity' => $person])

                    @if($isVerified == false)
                        <small><a href="{{ route('discover.people.requestDeletion', $person->slug) }}" class="text-danger">Request deletion</a></small>
                    @endif
                </div>
            </div>
        @endauth
    @endisset

    @include('discover.includes.show-end')

@endsection
