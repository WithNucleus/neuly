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

        @include('sidebars.primary')

        <main id="index-main" role="main" class="col-lg-9 col-xl-10 ml-auto">
            @include('discover.includes.status-messages')

            <div class="row">

                <div class="col-12">
                    <div class="full-width-show-view">

                        <div class="page-title-default d-md-flex justify-content-between">
                            <h1 class="mb-0 mr-5">Focus</h1>

                            <span class="lead-smaller align-self-end pb-1">
                                    Showing {{ $focus->total() }} Focus
                                </span>
                        </div>

                        {{-- Sorting --}}
                        @isset($sort)
                            <div class="sort-container font-size-small mt-3 mb-3">
                                <strong class="text-uppercase mr-3 text-black-50">Sort by:</strong>
                                <div class="d-inline sort-name text-uppercase">

                                    @include('discover.includes.filters.sort-button-default', [
                                        'asc' => 'asc',
                                        'desc' => 'desc',
                                        'label' => 'Clinical Trials'
                                    ])
                                </div>
                            </div>
                        @endisset

                        {{-- Filters --}}
                        <?php if (
                        (isset($filters_companies) && $filters_companies) ||
                        (isset($filters_locations) && $filters_locations)
                        ) : ?>
                        <div class="current-filter-list font-size-small align-self-end border-bottom mb-3 pb-1">
                            <strong class="text-uppercase mr-3 text-black-50">Current Filters:</strong>

                            <?php if (isset($filters_companies) && $filters_companies) : ?>
                            <span class="mr-3">
                                        <i class="fad fa-map-marker-alt text-info"></i>
                                        @foreach ($filters_companies as $company)
                                    {{ $company }}
                                    @if (!$loop->last) <strong class="text-info">/</strong> @endif
                                @endforeach
                                    </span>
                            <?php endif; ?>
                            <?php if (isset($filters_focus) && $filters_focus) : ?>
                            <strong class="text-info">/</strong>
                            <?php endif; ?>
                            <?php if (isset($filters_locations) && $filters_locations) : ?>
                            <span class="mr-3">
                                        <i class="fad fa-map-marker-alt text-info"></i>
                                        @foreach ($filters_locations as $location)
                                    {{ $location }}
                                    @if (!$loop->last) <strong class="text-info">/</strong> @endif
                                @endforeach
                                    </span>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>

                        <div class="d-flex flex-wrap">
                            <table class="table table-striped">
                                <thead>
                                <th scope="col">Name</th>
                                <th scope="col">Clinical Trials</th>
                                </thead>
                                <tbody>
                                @foreach($focus as $item)
                                    <tr>
                                        <td><a href="{{ route('discover.focus.show', $item->slug) }}">{{ $item->name }}</a></td>
                                        <td>{{ $item->trials }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{ $focus->links() }}
                    </div>
                </div>
            </div>
        </main>
    </div>
    @include('discover.includes.limited-access-modal')
@endsection

