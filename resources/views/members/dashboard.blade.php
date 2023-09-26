@extends('layouts.entity-show')

@section('head')
    <style>
        .dashboard-sortable-grid .drag-handle {
            position: absolute;
            right: 15px;
            top: 0;
            font-size: 2rem;
            visibility: hidden;
            cursor: move;
        }
        .dashboard-sortable-grid > div:hover .drag-handle {
            visibility: visible;
        }
    </style>
@endsection

@section('breadcrumbs')
    @include('navbars.breadcrumb', [
        'items' => [
            'Dashboard'  => false
        ]
    ])
@endsection

@section('content')

    <div class="container-fluid p-3">
        @include('members.includes.status-messages')
        <div class="row">
            <div class="col-12 col-md-6 col-xl-4 px-3">
                <div class="mb-5">
                    @include('members.dashboard-widgets.person-listing')
                </div>
                <div class="mb-5">
                    @include('members.dashboard-widgets.notes')
                </div>
                <div class="mb-5">
                    @include('members.dashboard-widgets.team')
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-4 px-3">
                <div class="mb-5">
                    @include('members.dashboard-widgets.clinical-trial-participant')
                </div>
                <div class="mb-5">
                    @include('members.dashboard-widgets.following')
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-4 px-3">
                <div class="mb-5">
                    @include('members.dashboard-widgets.recent')
                </div>
            </div>
        </div>
    </div>

@endsection
