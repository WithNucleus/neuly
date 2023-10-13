<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Neuly') }}</title>

        {{-- Fonts --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&family=Heebo:wght@800&display=swap" rel="stylesheet">

        {{-- Styles --}}
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <script src="https://kit.fontawesome.com/88643155ec.js" crossorigin="anonymous"></script>

        @include('layouts.includes._favicons')

        @yield('head')
    </head>
    <body class="@yield('body-class', '')">
        @include('navbars.primary')
        <div class="adminx-page-container d-flex flex-column flex-lg-row w-100">
            <div class="adminx-sidebar">
                <button class="btn btn-primary mt-3 ms-3 d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">Toggle Sidebar</button>
                <div class="offcanvas-lg offcanvas-start" tabindex="-1" id="offcanvasSidebar"
                     aria-labelledby="offcanvasSidebarLabel">
                    <div class="offcanvas-header">
                        <h5 class="h3 offcanvas-title" id="offcanvasSidebarLabel">
                            <a class="navbar-brand" href="/">
                                @include('navbars.neuly-logo')
                            </a>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                data-bs-target="#offcanvasSidebar" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div class="w-100 p-2">
                            <x-sidebar.list-group groupRoute="research" label="Research">
                                    <x-sidebar.list-group-item url="" label="Paid Subscribers" />
                                <x-sidebar.list-group-item url="{{ route('adminx.research.research-requests') }}" label="Research Requests" />
                                </x-sidebar.list-group>
                                <x-sidebar.list-group groupRoute="edu" label="EDU">
                                    <x-sidebar.list-group-item url="{{ route('adminx.edu.students') }}" label="Students" />
                                    <x-sidebar.list-group-item url="" label="Partners" />
                                    <x-sidebar.list-group-item url="" label="Referrers" />
                                </x-sidebar.list-group>
                                <x-sidebar.list-group groupRoute="care" label="Care">
                                    <x-sidebar.list-group-item url="{{ route('adminx.care.care-requests') }}" label="Care Inquiries" />
                                    <x-sidebar.list-group-item url="" label="Partners" />
                                    <x-sidebar.list-group-item url="" label="Referrers" />
                                </x-sidebar.list-group>
                            @can('import')
                                <x-sidebar.list-group groupRoute="import" label="Import">
                                    <x-sidebar.list-group-item url="{{ route('adminx.import.clinical-trials.index') }}" label="Clinical Trials" />
                                    <x-sidebar.list-group-item url="{{ route('adminx.import.courses.index') }}" label="Courses" />
                                </x-sidebar.list-group>
                            @endcan
                            @can('edit companies')
                                <x-sidebar.list-group groupRoute="entities" label="Entities">
                                    <x-sidebar.list-group-item url="{{ route('adminx.clinical-trials.index') }}" label="Clinical Trials" />
                                    <x-sidebar.list-group-item url="{{ route('adminx.courses.index') }}" label="Courses" />
                                    <x-sidebar.list-group-item url="" label="Organizations" />
                                    <x-sidebar.list-group-item url="" label="People" />
                                    <x-sidebar.list-group-item url="" label="Jobs" />
                                    <x-sidebar.list-group-item url="" label="Events" />
                                    <x-sidebar.list-group-item url="" label="Research" />
                                </x-sidebar.list-group>
                            @endcan

                            @can('edit users')
                                <x-sidebar.list-group groupRoute="users" label="Users">
                                    <x-sidebar.list-group-item url="{{ route('adminx.auth.users.index') }}" label="Manage Users" />
                                    <x-sidebar.list-group-item url="{{ route('adminx.auth.roles-permissions.index') }}" label="Roles & Permissions" />
                                    @can('edit feedback')
                                        <x-sidebar.list-group-item url="{{ route('adminx.misc.feedback') }}" label="Feedback" />
                                        <x-sidebar.list-group-item url="{{ route('adminx.misc.search-logs') }}" label="Search Logs" />
                                    @endcan
                                </x-sidebar.list-group>
                            @endcan

                            @can('email marketing')
                                <x-sidebar.list-group groupRoute="emails" label="Email Marketing">
                                    <x-sidebar.list-group-item url="{{ route('adminx.emails.templates.index') }}" label="Email Templates" />
                                    <x-sidebar.list-group-item url="{{ route('adminx.emails.journeys.index') }}" label="Email Journeys" />
                                    <x-sidebar.list-group-item url="{{ route('adminx.emails.triggers.index') }}" label="Email Triggers" />
                                    <x-sidebar.list-group-item url="{{ route('adminx.emails.emails.index') }}" label="Email History" />
                                    <x-sidebar.list-group-item url="{{ route('adminx.emails.preferences.index') }}" label="Email Preferences" />
{{--                                    <x-sidebar.list-group-item url="{{ route('adminx.emails.drips') }}" label="Email Drips" />--}}
                                </x-sidebar.list-group>
                            @endcan

                            <x-sidebar.list-group groupRoute="misc" label="Misc">
                                @can('view logs')
                                    <x-sidebar.list-group-item url="/horizon" label="Horizon" />
                                    <x-sidebar.list-group-item url="/admin/log" label="Logs" />
                                @endcan
                            </x-sidebar.list-group>

                            <ul class="list-unstyled ps-0">
                                <li class="mb-1">
                                    <button
                                        class="btn btn-toggle d-inline-flex align-items-center rounded border-0 {{ ($currentRoute === 'nav-tiles') ? 'show active' : 'collapsed' }}"
                                        data-bs-toggle="collapse" data-bs-target="#nav-tiles" aria-expanded="{{ ($currentRoute === 'nav-tiles') ? 'true' : 'false' }}">
                                        Navigation Tiles
                                    </button>
                                    <div class="collapse {{ ($currentRoute === 'nav-tiles') ? 'show' : '' }}" id="nav-tiles">
                                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1">
                                            <li>
                                                <a href="{{ route('adminx.nav-tiles.index') }}" class="link-body-emphasis d-inline-flex text-decoration-none rounded">All Nav Tiles</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('adminx.nav-tiles.create') }}" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Create New Tile</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="adminx-content w-100">
                @yield('content')
            </div>
        </div>
        <div id="toast-container" class="toast-container position-fixed bottom-0 end-0 p-3"></div>
        <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
        <script type="text/javascript" src="{{ mix('js/admin.js') }}"></script>
        @yield('after_scripts')
        @livewireScripts
        @yield('livewire_scripts')
        <script>
            let directoryElement = document.querySelector('.adminx-content');
            let directoryTop = directoryElement.offsetTop - 100;
            Livewire.on('gotoTop', () => {
                directoryElement.scrollTop = directoryTop;
            });
        </script>
    </body>
</html>
