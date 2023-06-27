@extends('layouts.entity-show')

@section('breadcrumbs')
    @include('navbars.breadcrumb', [
        'items' => [
            'Investors' => route('discover.investors'),
            $investor->name  => false
        ]
    ])
@endsection

@section('content')

    <div class="container py-4">

        <x-entities.entity-show-title-meta title="{{ $investor->name }}">
            <div class="me-3">
                @include('members.follow.button', [
                    'followable_type' => get_class($investor),
                    'followable_id' => $investor->id,
                    'name' => $investor->name
                ])
            </div>

            @if ($investor->jobs->count() > 0)
                <a href="{{ route('discover.investors.jobs', $investor->slug) }}" class="text-decoration-none text-uppercase me-3 text-danger">
                    <i class="fad fa-briefcase"></i> Hiring
                </a>
            @endif
        </x-entities.entity-show-title-meta>

        @include('discover.investors.data')

        <div class="d-flex flex-wrap justify-content-between align-items-center text-uppercase small fw-bold text-secondary-emphasis mt-4">
            <div class="me-4">
                Last updated: {{ Carbon\Carbon::parse($investor->updated_at)->format('M d, Y') }}
            </div>
            @can('edit investors')
                <div>
                    <a href="{{ route('investor.edit', $investor->id) }}" class="text-secondary-emphasis">Edit Investor</a>
                </div>
            @endcan
            <div>
                @include('discover.includes.update-listing-form', ['entity' => $investor])
            </div>
        </div>
    </div>

@endsection
