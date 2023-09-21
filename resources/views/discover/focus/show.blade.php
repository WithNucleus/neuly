@extends('layouts.entity-show')

@section('breadcrumbs')
    @include('navbars.breadcrumb', [
        'items' => [
            'Focus' => route('discover.focus'),
            $focus->name  => false
        ]
    ])
@endsection

@section('content')

    <div class="container py-4">

        <x-entities.entity-show-title-meta title="{{ $focus->name }}" headingClasses="max-width-780 text-success mb-2">
            <div class="me-3">
                @include('members.follow.button', [
                    'followable_type' => get_class($focus),
                    'followable_id' => $focus->id,
                    'name' => $focus->name
                ])
            </div>
        </x-entities.entity-show-title-meta>

        @include('discover.focus.data')
    </div>

    @include('footers.full')

@endsection
