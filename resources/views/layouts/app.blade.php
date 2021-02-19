<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @isset($metas)
        @if(!empty($metas['title']))
            <title>{{ $metas['title'] }}</title>
            <meta property="og:title" content="{{ $metas['title'] }}" />
            <meta name="twitter:title" content="{{ $metas['title'] }}" />
        @else
            <title>{{ config('app.name', 'Neuly') }}</title>
        @endif

        @if(!empty($metas['description']))
            <meta name="description" lang="{{ app()->getLocale() }}" content="{{ $metas['description'] }}" />
            <meta property="og:description" content="{{ $metas['description'] }}">
            <meta name="twitter:description" content="{{ $metas['description'] }}" />
        @endif
        @if(!empty($metas['image']))
            <meta property="og:image" content="{{ $metas['image'] }}" />
            <meta name="twitter:card" content="summary_large_image" />
        @endif

    @else
        {{-- Fallbacks --}}
        <title>{{ config('app.name', 'Neuly') }}</title>
        <meta property="og:title" content="{{ config('app.name', 'Neuly') }}" />
        <meta name="twitter:title" content="{{ config('app.name', 'Neuly') }}" />
    @endisset

    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ request()->url() }}" />
    <link rel="canonical" href="{{ request()->url() }}" />
    <meta property="og:site_name" content="{{ config('app.name', 'Neuly') }}" />
    <meta property="og:locale" content="{{ app()->getLocale() }}_US" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i|Solway:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome.css') }}">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('images/favicons/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('images/favicons/safari-pinned-tab.svg') }}" color="#5bbad5">
    <link rel="shortcut icon" href="{{ asset('images/favicons/favicon.ico') }}">
    <meta name="apple-mobile-web-app-title" content="Neuly">
    <meta name="application-name" content="Neuly">
    <meta name="msapplication-TileColor" content="#73fbd3">
    <meta name="msapplication-config" content="{{ asset('images/favicons/browserconfig.xml') }}">
    <meta name="theme-color" content="#ffffff">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    @if (Route::is('discover.insights'))
        <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
    @endif

    <script type="text/javascript" src="{{ asset('assets/chart.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/chartisan.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/typeahead.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/bootstrap-tagsinput.css') }}"/>

    @if (Route::is('insights.compare-market') ||
        Route::is('discover.clinicaltrials.recruiting')
    )
        <script type="text/javascript" src="{{ asset('assets/nouislider.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/wNumb.js') }}"></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/nouislider.css') }}"/>
    @endif

    @if (Route::is('insights.distribution.countries.show') OR
         Route::is('insights.distribution.countries.focus.show') OR
         Route::is('discover.locations.maps.global') OR
         Route::is('discover.locations.maps.country') OR
         Route::is('discover.investors.map') OR
         Route::is('discover.investors.map.country')
    )
        <script type="text/javascript" src="{{ asset('assets/jquery-jvectormap.min.js') }}"></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/jquery-jvectormap.css') }}"/>
    @endif

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-171437771-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-171437771-1');
    </script>

</head>
<body class="@yield('body-class', '')">
    <div id="app">
        @yield('content')
    </div>

    <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>

    @if(Route::is('index') OR Route::is('home'))
        <script type="text/javascript" src="{{ mix('js/home-hero.js') }}"></script>
    @endif

    @include('navbars.discover-menu')
    @include('navbars.admin-menu')

    @yield('after_scripts')
</body>
</html>
