@extends('layouts.entity-index')

@section('body-class', 'page-companies')

@section('breadcrumbs')
    @include('navbars.breadcrumb', [
        'items' => [
            'Organizations' => false
        ]
    ])
@endsection

@section('content')

    <livewire:public.entities.organization-index />

@endsection
