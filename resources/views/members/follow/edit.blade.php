@extends('layouts.app')

@section('breadcrumbs')
    @include('navbars.breadcrumb', [
        'items' => [
            'Dashboard' => route('member.dashboard'),
            'Following'  => false
        ]
    ])
@endsection

@section('content')

    @include('navbars.primary')

    <div class="container my-4">
        <h1>Follow Settings</h1>
        <h2 class="h3 text-accent">{{ $entity->followable->name }}</h2>
        <livewire:members.follow.follow-entity-widget :entity="$entity" />
    </div>

    @include('footers.full')
@endsection
