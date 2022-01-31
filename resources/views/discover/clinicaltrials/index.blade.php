@extends('layouts.app')

@section('body-class', 'page-clinicaltrials bg-light')

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
                        'Clinical Trials' => false
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
                        <div class="page-title-default d-md-flex justify-content-between mb-3">
                            <h1 class="mb-0 mr-5">Clinical Trials</h1>

                            <span class="lead-smaller align-self-end pb-1">
                                Showing {{ $clinicaltrials->total() }} Clinical Trials
                            </span>
                        </div>

                        <div class="d-md-flex justify-content-between align-items-center mb-3">
                            @isset($sort)
                                <div class="sort-container font-size-small">
                                    <strong class="text-uppercase mr-3 text-black-50">Sort by:</strong>
                                    <div class="d-inline sort-name text-uppercase">

                                        @include('discover.includes.filters.sort-button', [
                                            'asc' => 'title',
                                            'desc' => '-title',
                                            'label' => 'Title'
                                        ])

                                        @include('discover.includes.filters.sort-button-default', [
                                            'asc' => 'start',
                                            'desc' => '-start',
                                            'label' => 'Start Date'
                                        ])

                                        @include('discover.includes.filters.sort-button', [
                                            'asc' => 'updated',
                                            'desc' => '-updated',
                                            'label' => 'Last Updated'
                                        ])

                                    </div>
                                </div>
                            @endisset

                            <div class="switch-view mt-2 mb-3 my-md-0">
                                <div class="btn-group" role="group" aria-label="Switch Clinical Trial view">
                                    <a href="{{ route('discover.clinicaltrials') }}" class="btn btn-primary" title="List View" data-toggle="tooltip" data-placement="top"><i class="fad fa-list-ul fa-lg"></i></a>
                                    <a href="{{ route('insights.clinicaltrials.pipeline') }}" class="btn btn-outline-primary" title="Tracker" data-toggle="tooltip" data-placement="top"><i class="fad fa-stream fa-lg"></i></a>
                                </div>
                            </div>
                        </div>

                        @if(
                            isset($filters_location) && $filters_location OR
                            isset($filters_focus) && $filters_focus OR
                            isset($filters_status) && $filters_status OR
                            isset($filters_companies) && $filters_companies OR
                            isset($filters_researchers) && $filters_researchers OR
                            isset($filters_conditions) && $filters_conditions OR
                            isset($filters_interventions) && $filters_interventions OR
                            isset($filters_outcome_measures) && $filters_outcome_measures OR
                            isset($filters_study_designs) && $filters_study_designs OR
                            isset($filters_year) && $filters_year
                        )
                        <div class="current-filter-list font-size-small align-self-end mt-3 mb-3 border-bottom pb-1">
                            <strong class="text-uppercase mr-3 text-black-50">Current Filters:</strong>

                            @if(isset($filters_location) && $filters_location)
                                @include('discover.includes.filters.current-filter', [
                                    'iconClass' => 'fa-map-marker-alt',
                                    'items' => $filters_location
                                ])
                            @endif

                            @if(isset($filters_focus) && $filters_focus)
                                @include('discover.includes.filters.current-filter', [
                                    'iconClass' => 'fa-flask',
                                    'items' => $filters_focus
                                ])
                            @endif

                            @if(isset($filters_status) && $filters_status)
                                @include('discover.includes.filters.current-filter', [
                                    'iconClass' => 'fa-info-circle',
                                    'items' => $filters_status
                                ])
                            @endif

                            @if(isset($filters_companies) && $filters_companies)
                                @include('discover.includes.filters.current-filter', [
                                    'iconClass' => 'fa-building',
                                    'items' => $filters_companies
                                ])
                            @endif

                            @if(isset($filters_researchers) && $filters_researchers)
                                @include('discover.includes.filters.current-filter', [
                                    'iconClass' => 'fa-users',
                                    'items' => $filters_researchers
                                ])
                            @endif

                            @if(isset($filters_conditions) && $filters_conditions)
                                @include('discover.includes.filters.current-filter', [
                                    'iconClass' => 'fa-info-circle',
                                    'items' => $filters_conditions
                                ])
                            @endif

                            @if(isset($filters_interventions) && $filters_interventions)
                                @include('discover.includes.filters.current-filter', [
                                    'iconClass' => 'fa-info-circle',
                                    'items' => $filters_interventions
                                ])
                            @endif

                            @if(isset($filters_outcome_measures) && $filters_outcome_measures)
                                @include('discover.includes.filters.current-filter', [
                                    'iconClass' => 'fa-info-circle',
                                    'items' => $filters_outcome_measures
                                ])
                            @endif

                            @if(isset($filters_study_designs) && $filters_study_designs)
                                @include('discover.includes.filters.current-filter', [
                                    'iconClass' => 'fa-info-circle',
                                    'items' => $filters_study_designs
                                ])
                            @endif

                            @if(isset($filters_year) && $filters_year)
                                @include('discover.includes.filters.current-filter', [
                                    'iconClass' => 'fa-info-circle',
                                    'items' => $filters_year
                                ])
                            @endif
                        </div>
                        @endif

                        <ul class="list-group list-group-flush mb-4 shadow-sm">
                            @forelse($clinicaltrials as $clinicaltrial)
                                <li class="list-group-item py-4">

                                    <div class="row">
                                        <div class="col-12 col-md-7">
                                            <p class="lead-smaller mb-2">
                                               <a href="{{ route('discover.clinicaltrials.show', $clinicaltrial->slug) }}">{{ $clinicaltrial->title }}</a>
                                            </p>

                                            @if ($clinicaltrial->start_date != '' OR $clinicaltrial->last_update_posted != '')

                                                <p class="mb-2">
                                                    <i class="fad fa-calendar-day text-quaternary fa-lg mr-1"></i>

                                                    @if ($clinicaltrial->start_date != '')
                                                        <span class="mr-3">
                                                            <strong>Start Date:</strong> {{ \Carbon\Carbon::parse($clinicaltrial->start_date)->format('F Y') }}
                                                        </span>
                                                    @endif

                                                    @if ($clinicaltrial->last_update_posted != '')
                                                        <span class="mr-3">
                                                            <strong>Updated:</strong> {{ \Carbon\Carbon::parse($clinicaltrial->last_update_posted)->format('F Y') }}
                                                        </span>
                                                    @endif
                                                </p>

                                            @endif

                                            @if($clinicaltrial->locations->count() > 0)
                                                <div class="clinicaltrial-locations d-flex mb-2">
                                                    <?php $count = 0; ?>

                                                    <div class="icon text-info mr-2">
                                                        <i class="fad fa-globe-stand fa-lg"></i>
                                                    </div>

                                                    <div class="text">
                                                        @foreach ($clinicaltrial->locations as $location)

                                                            <?php $count++; ?>

                                                            @if($count == 4)
                                                                <button class="toggle-more btn btn-sm font-weight-bold text-uppercase btn-link text-info p-0 text-decoration-none" type="button" data-toggle="collapse" data-target="#location-more-{{ $location->id }}" aria-expanded="false" aria-controls="location-more-{{ $location->id }}">
                                                                    <span>Show More</span><i class="fad fa-arrow-square-down text-info ml-2"></i>
                                                                </button>
                                                                <div id="location-more-{{ $location->id }}" class="collapse">
                                                            @endif

                                                            {{ $location->name }} @if (!$loop->last)<br>@endif

                                                            @if($loop->last AND $clinicaltrial->locations->count() >= 4)
                                                                </div>
                                                            @endif

                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif

                                        </div>

                                        <div class="col-12 col-md-5">

                                            <div class="row">
                                                <div class="col-12 col-xl-6">
                                                    @if($clinicaltrial->focus->count() > 0)
                                                        <p class="mb-2">
                                                            <span class="text-secondarydark"><i class="fad fa-flask"></i></span>
                                                            @foreach($clinicaltrial->focus as $item)
                                                                {{ $item->name }}@if (!$loop->last),@endif
                                                            @endforeach
                                                        </p>
                                                    @endif

                                                    @if ($clinicaltrial->phases != '')
                                                        <p class="mb-2">
                                                            <i class="fad fa-clock text-quaternary"></i> {{ $clinicaltrial->phases }}
                                                        </p>
                                                    @endif
                                                </div>

                                                <div class="col-12 col-xl-6">
                                                    <p class="mb-2">
                                                        <i class="fad fa-info-circle text-danger"></i> {{ $clinicaltrial->status }}
                                                    </p>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </li>

                            @empty
                                <li class="list-group-item">
                                    <p class="lead mb-0">
                                        No clinical trials match your search criteria.
                                    </p>
                                </li>
                            @endforelse
                        </ul>

                        {{ $clinicaltrials->links() }}
                    </div>
                </div>

                @include('discover.includes.discover-footer-content')

            </main>

        </div>

    </div>

    <script>
        // Toggle plus minus icon on show hide of collapse element
        $(".collapse").on('show.bs.collapse', function(){

            $(this).prev(".toggle-more").find(".fad").removeClass("fa-arrow-square-down").addClass("fa-arrow-square-up");
            $(this).prev(".toggle-more").find("span").html("Show Less");

        }).on('hide.bs.collapse', function(){

            $(this).prev(".toggle-more").find(".fad").removeClass("fa-arrow-square-up").addClass("fa-arrow-square-down");
            $(this).prev(".toggle-more").find("span").html("Show More");

        });
    </script>

    @include('discover.includes.limited-access-modal')
@endsection
