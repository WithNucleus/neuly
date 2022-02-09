@extends('layouts.app')

@section('body-class', 'page-news bg-light')

@section('content')

    @include('navbars.primary')

    <div class="container-fluid">
        {{-- Discover Tabs Desktop --}}
        <div class="row">
            <div class="col-12 navbar-tabs-container">
                @include('navbars.tabs')
            </div>
        </div>
    </div>

    {{-- Discover Tabs Mobile --}}
    @include('navbars.tabs-mobile')

    <div class="container-fluid">
        {{-- Breadcrumbs --}}
        <div class="row">
            <div class="col-12 breadcrumbs-container bg-white shadow-sm">
                @include('navbars.breadcrumb', [
                    'items' => [
                        'Insights' => route('discover.insights'),
                        'Patents Tracker' => false
                    ]
                ])
            </div>
        </div>

        {{-- Sidebar and Content Area --}}
        <div class="row">

            @include('sidebars.primary')

            <main id="index-main" role="main" class="col-lg-9 col-xl-10 ml-auto">
                @include('discover.includes.status-messages')

                <div class="row">

                    <div class="col-12">
                        <div class="full-width-show-view">

                            <div class="page-title-default d-md-flex justify-content-between mb-4">
                                <h1 class="mb-0 mr-5">Patents Tracker</h1>

                                <span class="lead-smaller align-self-end pb-1">
                                    Showing {{ $patents->total() }} Patents
                                </span>
                            </div>

                            <div class="d-md-flex justify-content-between align-items-center mb-3">
                                {{-- Sorting --}}
                                @isset($sort)
                                    <div class="sort-container font-size-small mt-3 mb-3">
                                        <strong class="text-uppercase mr-3 text-black-50">Sort by:</strong>
                                        <div class="d-inline sort-name text-uppercase">

                                            @include('discover.includes.filters.sort-button-default', [
                                                'asc' => 'priority_date',
                                                'desc' => '-priority_date',
                                                'label' => 'Priority Date'
                                            ])

                                            @include('discover.includes.filters.sort-button', [
                                                'asc' => 'granted_date',
                                                'desc' => '-granted_date',
                                                'label' => 'Granted Date'
                                            ])

                                            @include('discover.includes.filters.sort-button', [
                                                'asc' => 'expiration_date',
                                                'desc' => '-expiration_date',
                                                'label' => 'Expiration Date'
                                            ])

                                            @include('discover.includes.filters.sort-button', [
                                                'asc' => 'name',
                                                'desc' => '-name',
                                                'label' => 'Title'
                                            ])

                                        </div>
                                    </div>
                                @endisset

                                <div class="switch-view mt-2 mb-3 my-md-0">
                                    <div class="btn-group" role="group" aria-label="Switch Patent view">
                                        <a href="{{ route('discover.patents') }}" class="btn btn-outline-primary" title="List View" data-toggle="tooltip" data-placement="top">
                                            <i class="fad fa-list-ul fa-lg"></i>
                                        </a>
                                        <a href="{{ route('discover.patents.tracker') }}" class="btn btn-primary" title="Tracker" data-toggle="tooltip" data-placement="top">
                                            <i class="fad fa-stream fa-lg"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            {{-- Filters --}}
                            <?php if (isset($filters_focus) && $filters_focus) : ?>
                            <div class="current-filter-list font-size-small align-self-end border-bottom mb-3 pb-1">
                                <strong class="text-uppercase mr-3 text-black-50">Current Filters:</strong>

                                <span class="mr-3">
                                    <i class="fad fa-flask text-secondarydark"></i>
                                    @foreach ($filters_focus as $focus)
                                        {{ $focus }}
                                        @if (!$loop->last) <strong class="text-info">/</strong> @endif
                                    @endforeach
                                </span>

                            </div>
                            <?php endif; ?>

                            {{-- Patents --}}
                            <div id="resizable-fullscreen-table-container">
                                <button id="close-full-screen-table" class="btn d-none mb-3 btn-dark text-uppercase"><i class="fas fa-times"></i> Close</button>
                                <div class="position-relative">
                                    <table class="table bg-white mb-0" id="resizable-table-with-all-borders">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th class="size-130 text-no-wrap sticky-top">Title</th>
                                            <th class="text-no-wrap sticky-top">Owner / Applicant</th>
                                            <th class="size-200 text-no-wrap sticky-top">Status</th>
                                            <th class="size-130 text-no-wrap sticky-top">Priority Date</th>
                                            <th class="size-130 text-no-wrap sticky-top">Granted Date</th>
                                            <th class="size-130 text-no-wrap sticky-top">Expiration Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($patents as $patent)
                                            <tr>
                                                <td class="max-width-450">
                                                    <span class="font-weight-bold">
                                                        {{ $patent->name }}
                                                    </span>
                                                    <div class="text-muted">
                                                        {{ $patent->summary }}
                                                    </div>
                                                    <div class="text-secondarydark">
                                                        <i class="fad fa-flask"></i>
                                                        @foreach ($patent->focus as $item)
                                                            {{ $item->name }}
                                                            @if (!$loop->last) / @endif
                                                        @endforeach
                                                    </div>
                                                </td>
                                                <td class="max-width-450">
                                                    @foreach ($patent->companies as $item)
                                                        <a href="{{ route('discover.organizations.show', $item->slug) }}">{{ $item->name }}</a>
                                                        @if (!$loop->last) / @endif
                                                    @endforeach
                                                    @if ($patent->companies->count() > 0 AND $patent->people->count() > 0)
                                                        /
                                                    @endif
                                                    @foreach ($patent->people as $item)
                                                        <a href="{{ route('discover.people.show', $item->slug) }}">{{ $item->name }}</a>
                                                        @if (!$loop->last) / @endif
                                                    @endforeach

                                                    <span class="d-block font-size-small text-muted">
                                                        Patent #
                                                        <a href="{{ $patent->url }}" target="_blank" rel="noopener noreferrer" class="text-muted">
                                                            {{ $patent->patent_number }}
                                                        </a>
                                                    </span>
                                                </td>
                                                <td class="status-{{ strtolower($patent->status) }}">
                                                    {{ $patent->status }}<br>
                                                </td>
                                                <td>
                                                    @if ($patent->priority_date != '')
                                                        {{ Carbon\Carbon::parse($patent->priority_date)->format('Y-m-d') }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($patent->granted_date != '')
                                                        {{ Carbon\Carbon::parse($patent->granted_date)->format('Y-m-d') }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($patent->expiration_date != '')
                                                        {{ Carbon\Carbon::parse($patent->expiration_date)->format('Y-m-d') }}
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6">
                                                    No patents match your search criteria.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </table>
                                </div>
                            </div>

                            <div class="tracker-key mt-3">
                                <span class="mr-4">
                                    <span class="status-filed border">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Filed
                                </span>
                                <span class="mr-4">
                                    <span class="status-pending border">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Pending
                                </span>
                                <span class="mr-4">
                                    <span class="status-published border">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Published
                                </span>
                                <span class="mr-4">
                                    <span class="status-granted border">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Granted
                                </span>
                                <span class="mr-4">
                                    <span class="status-abandoned border">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Abandoned / Expired
                                </span>
                            </div>

                            {{ $patents->links() }}
                        </div>
                    </div>

                </div>

                @include('discover.includes.discover-footer-content')

            </main>

        </div>

    </div>

    <style>
        .full-width-show-view {
            max-width: 100%;
        }

        .status-filed {
            background-color: #FFF9C4;
        }

        .status-pending {
            background-color: #efe5fd;
        }

        .status-published {
            background-color: #E3F2FD;
        }

        .status-granted {
            background-color: #E8F5E9;
        }

        .status-abandoned,
        .status-expired {
            background-color: #FBE9E7;
        }
    </style>
    @include('discover.includes.limited-access-modal')
@endsection
