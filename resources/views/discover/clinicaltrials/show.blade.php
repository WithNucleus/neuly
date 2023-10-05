@extends('layouts.entity-show')

@section('breadcrumbs')
    @include('navbars.breadcrumb', [
        'items' => [
            'Clinical Trials' => route('discover.clinicaltrials'),
            $clinicalTrial->name  => false
        ]
    ])
@endsection

@section('content')

    <div class="container py-4">

        <x-entities.entity-show-title-meta title="{{ urlencode($clinicalTrial->name) }}" headingClasses="text-success h2 text-transform-none mb-2 max-width-780">
            <div class="me-3">
                @include('members.follow.button', [
                    'followable_type' => get_class($clinicalTrial),
                    'followable_id' => $clinicalTrial->id,
                    'name' => $clinicalTrial->name
                ])
            </div>
        </x-entities.entity-show-title-meta>

        @can('edit clinical trials')
            @if($clinicalTrial->imported)
                <div class="mb-4 border border-2 border-success-subtle p-3">
                    <livewire:admin.import.clinical-trials.match-entity wire:key="record-{{ $clinicalTrial->imported->id }}" :importedEntity="$clinicalTrial->imported" showPage="true" />
                </div>
            @endif
        @endcan

        @include('discover.clinicaltrials.data')

        <div class="d-flex flex-wrap justify-content-between align-items-center text-uppercase small fw-bold text-secondary-emphasis mt-4">
            <div class="me-4">
                Last updated: {{ Carbon\Carbon::parse($clinicalTrial->updated_at)->format('M d, Y') }}
            </div>
            @can('edit clinical trials')
                <div>
                    <a href="{{ route('clinicaltrial.edit', $clinicalTrial->id) }}" class="text-secondary-emphasis">Edit Clinical Trial</a>
                </div>
            @endcan
            <div>
                @include('discover.includes.update-listing-form', ['entity' => $clinicalTrial])
            </div>
        </div>
    </div>

@endsection
