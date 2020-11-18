<?php
/**
 * @param boolean $full_width = false;
 */
?>

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

            @if(Route::is('discover.organizations.show'))

                @include('discover.includes.breadcrumbs.company')

            @elseif (Route::is('discover.people.show'))

                @include('discover.includes.breadcrumbs.person')

            @elseif (Route::is('discover.research.show'))

                @include('discover.includes.breadcrumbs.research')

            @elseif (Route::is('discover.locations.show'))

                @include('discover.includes.breadcrumbs.location')

            @elseif (Route::is('discover.focus.show'))

                @include('discover.includes.breadcrumbs.focus')

            @elseif (Route::is('discover.events.show'))

                @include('discover.includes.breadcrumbs.event')

            @elseif (Route::is('discover.jobs.show') OR Route::is('discover.jobs.apply'))

                @include('discover.includes.breadcrumbs.job')

            @elseif (Route::is('discover.investors.show'))

                @include('discover.includes.breadcrumbs.investor')

            @elseif (Route::is('discover.clinicaltrials.show'))

                @include('discover.includes.breadcrumbs.clinicaltrial')

            @elseif (Route::is('member.dashboard'))

                @include('discover.includes.breadcrumbs.member-dashboard')

            @elseif (Route::is('discover.organizations.jobs'))

                @include('discover.includes.breadcrumbs.company-jobs')

            @elseif (Route::is('discover.organizations.events'))

                @include('discover.includes.breadcrumbs.company-events')

            @elseif (Route::is('discover.investors.jobs'))

                @include('discover.includes.breadcrumbs.investor-jobs')

            @endif

        </div>
    </div>

</div>
<div class="container-fluid">

@if ($full_width == true)
    <main id="show-main" role="main" class="full-width-show-view mx-auto">
        <div class="p-4">

@else
    <main id="show-main" role="main" class="col-md-11 col-xl-8 mx-auto">
        <div class="p-4 bg-white shadow-sm">
@endif
