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
    <meta property="og:url" content="{{ request()->fullUrl() }}" />
    <link rel="canonical" href="{{ request()->fullUrl() }}" />
    <meta property="og:site_name" content="{{ config('app.name', 'Neuly') }}" />
    <meta property="og:locale" content="{{ app()->getLocale() }}_US" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,700,700i|Solway:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

    {{-- Local Styles --}}
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome.css') }}">

    {{-- Favicons --}}
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

    {{-- Jquery --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    {{-- Popper --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    
    {{-- Bootstrap Javascript --}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    {{-- Google Analytics --}}
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-171437771-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-171437771-1');
    </script>
</head>
<body class="@yield('body-class', 'bg-light')">
    <div id="app">
        @yield('content')
    </div>

    <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
</body>
</html>