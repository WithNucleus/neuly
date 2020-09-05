@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('navbars.primary')

    <div class="container-fluid">

        <div class="row">
            <div class="col-12 navbar-tabs-container">
                @include('navbars.tabs')
            </div>
        </div>

        <div class="row">
            @include('navbars.tabs-mobile')
        </div>

        <div class="row">
            <div class="col-12 breadcrumbs-container bg-white shadow-sm">

                @include('navbars.breadcrumb', [
                    'items' => [
                        'Insights' => false,
                    ]
                ])

            </div>
        </div>
    </div>

    <div class="row">
        <main id="index-main" role="main" class="col-lg-9 col-xl-10 ml-auto">
            @include('discover.includes.status-messages')

            <div class="row">

                <div class="col-12">
                    <div class="full-width-show-view">

                        <div class="page-title-default d-md-flex justify-content-between">
                            <h1 class="mb-0 mr-5">Collaborators</h1>

                            <span class="lead-smaller align-self-end pb-1">
                                    Showing {{ $collaborators->total() }} Organizations
                                </span>
                        </div>
                        <div class="d-flex flex-wrap">
                            <table class="table table-striped">
                                <thead>
                                    <th scope="col">Name</th>
                                    <th scope="col">Clinical Trials</th>
                                </thead>
                                <tbody>
                                @foreach($collaborators as $collaborator)
                                    <tr>
                                        <td><a href="{{ route('discover.organizations.show', $collaborator->slug) }}">{{ $collaborator->name }}</a></td>
                                        <td>{{ $collaborator->trials }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{ $collaborators->links() }}
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
