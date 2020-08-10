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
                <div class="row">

                    <div class="col-12">
                        <div class="full-width-show-view">

                            <div class="page-title-default d-md-flex justify-content-between mb-3">
                                <h1 class="mb-0 mr-5">Clinical Trials</h1>

                                <span class="lead-smaller align-self-end pb-1">
                                    Showing {{ $clinicaltrials->total() }} Clinical Trials
                                </span>
                            </div>

                            {{-- Sorting --}}
                            @isset($sort)
                                <div class="sort-container font-size-small mt-3 mb-3">
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
    
                            <?php if (
                                isset($filters_location) && $filters_location OR 
                                isset($filters_company_name) && $filters_company_name OR 
                                isset($filters_focus) && $filters_focus OR 
                                isset($filters_status) && $filters_status
                                ) : ?>
                            <div class="current-filter-list font-size-small align-self-end mt-3 mb-3 border-bottom pb-1">
                                <strong class="text-uppercase mr-3 text-black-50">Current Filters:</strong>

                                <?php if (isset($filters_location) && $filters_location) : ?>
                                        <span class="mr-3">
                                            <i class="fad fa-map-marker-alt text-info"></i>
                                            @foreach ($filters_location as $location)
                                                {{ $location }}
                                                @if (!$loop->last) <strong class="text-info">/</strong> @endif
                                            @endforeach
                                        </span>
                                <?php endif; ?>

                                <?php if (isset($filters_company_name) && $filters_company_name) : ?>
                                        <span class="mr-3">
                                            <i class="fad fa-building text-secondarydark"></i>
                                            @foreach ($filters_company_name as $company)
                                                {{ $company }}
                                                @if (!$loop->last) <strong class="text-black-50">/</strong> @endif
                                            @endforeach
                                        </span>
                                <?php endif; ?>

                                <?php if (isset($filters_focus) && $filters_focus) : ?>
                                        <span class="mr-3">
                                            <i class="fad fa-flask text-secondarydark"></i>
                                            @foreach ($filters_focus as $focus)
                                                {{ $focus }}
                                                @if (!$loop->last) <strong class="text-black-50">/</strong> @endif
                                            @endforeach
                                        </span>
                                <?php endif; ?>

                                <?php if (isset($filters_status) && $filters_status) : ?>
                                    @if($filters_status)
                                        <span class="mr-3">
                                            <i class="fad fa-info-circle text-black-50"></i>
                                            @foreach ($filters_status as $status)
                                                {{ $status }}
                                                @if (!$loop->last) <strong class="text-black-50">/</strong> @endif
                                            @endforeach
                                        </span>
                                    @endif
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>

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

@endsection