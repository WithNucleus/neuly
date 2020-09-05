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

            @if (Route::is('member.dashboard'))

                @include('discover.includes.breadcrumbs.member-dashboard')

            @elseif (Route::is('member.follow-lists.index'))

                @include('discover.includes.breadcrumbs.follow-lists')

            @elseif (Route::is('member.follow-lists.show') OR Route::is('member.follow-lists.edit'))

                @include('discover.includes.breadcrumbs.follow-lists-show-edit')

            @elseif (Route::is('member.follow.index'))

                @include('discover.includes.breadcrumbs.follows')

            @elseif (Route::is('member.follow.edit'))

                @include('discover.includes.breadcrumbs.follows-edit')

            @elseif (Route::is('member.notes.index'))

                @include('discover.includes.breadcrumbs.notes')

            @elseif (Route::is('member.notes.create'))

                @include('discover.includes.breadcrumbs.notes-create')

            @elseif (Route::is('member.notes.show') OR Route::is('member.notes.edit'))

                @include('discover.includes.breadcrumbs.notes-show')

            @elseif (Route::is('members.public.note'))

                @include('discover.includes.breadcrumbs.notes-public')

            @elseif (Route::is('members.follow-lists.public'))

                @include('discover.includes.breadcrumbs.follow-lists-public')

            @endif

        </div>
    </div>

	<div class="row">

        <main id="show-main" role="main" class="col-12">
