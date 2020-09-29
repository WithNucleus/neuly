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
                        'Insights' => route('discover.insights'),
                        'Research Organizations' => false,
                    ]
                ])

            </div>
        </div>

        <div class="row">

            @include('sidebars.primary')

            <main id="index-main" role="main" class="col-lg-9 col-xl-10 ml-auto">
                @include('discover.includes.status-messages')

                <div class="full-width-show-view">

                    <div class="page-title-default d-md-flex justify-content-between">
                        <h1 class="mb-0 mr-5">Research Organizations</h1>

                        <span class="lead-smaller align-self-end pb-1">
                            Showing {{ $data->total() }} Organizations
                        </span>
                    </div>

                    {{-- Sort --}}
                    @isset($sort)
                        <div class="sort-container font-size-small mt-3 mb-3">
                            <strong class="text-uppercase mr-3 text-black-50">Sort by:</strong>
                            <div class="d-inline sort-name text-uppercase">

                                @include('discover.includes.filters.sort-button-default', [
                                    'asc' => 'asc',
                                    'desc' => 'desc',
                                    'label' => 'Research'
                                ])
                            </div>
                        </div>
                    @endisset

                    <div class="d-flex flex-wrap">
                        <table class="table table-striped">
                            <thead>
                                <th scope="col">Name</th>
                                <th scope="col">Research</th>
                            </thead>
                            <tbody>
                            @foreach($data as $item)
                                <tr>
                                    <td><a href="{{ route('discover.people.show', $item->slug) }}">{{ $item->name }}</a></td>
                                    <td>{{ $item->total }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $data->links() }}

                </div>
            </main>

        </div>
    </div>
@endsection

