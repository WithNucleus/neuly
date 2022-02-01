@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('discover.includes.show-begin', ['full_width' => false])

        <p class="dashboard-actions-container m-2 float-right">
            @include('members.follow.button', [
                'followable_type' => get_class($investor),
                'followable_id' => $investor->id,
                'name' => $investor->name,
            ])
        </p>

    @if($investor->jobs->count() > 0)
        <p class="text-uppercase m-2 float-right font-weight-bold">
            @if ($investor->jobs->count() > 0)
                <a href="{{ route('discover.investors.jobs', $investor->slug) }}" class="text-decoration-none mr-2 text-danger">
                    <i class="fad fa-briefcase"></i> Hiring
                </a>
            @endif
        </p>
    @endif

    <h1>{{ $investor->name }}</h1>

    @include('discover.includes.status-messages')

    @include('discover.investors.data')

    @auth
    <div class="row">
        <div class="col-sm-6">
            <small>Last updated: {{ Carbon\Carbon::parse($investor->updated_at)->format('M d, Y') }}</small>
        </div>
        <div class="col-sm-6 text-right">
            @include('discover.includes.update-listing-form', ['entity' => $investor])
        </div>
    </div>
    @endauth

    @include('discover.includes.show-end')
    @include('discover.includes.limited-access-modal')

@endsection
