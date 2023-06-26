<?php
/**
 * @param boolean $full_width = false;
 */
?>

@include('navbars.primary')

<div class="container-fluid">

    <div class="row">
        <div class="col-12 breadcrumbs-container bg-primary-subtle py-2">

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

            @elseif (Route::is('discover.podcasts.show'))

                @include('discover.includes.breadcrumbs.podcast-show')

            @elseif (Route::is('discover.bookable-listing.show'))

                @include('discover.includes.breadcrumbs.bookable-listings')

            @endif

        </div>
    </div>

</div>
<div class="container-fluid">

@if ($full_width == true)
    <main id="show-main" role="main" class="container-fluid">
        <div class="py-4">

@else
    <main id="show-main" role="main" class="container">
        <div class="py-4">
@endif
