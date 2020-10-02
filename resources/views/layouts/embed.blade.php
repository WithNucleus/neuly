<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Neuly') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i|Solway:400,700"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

    {{-- Local Styles --}}
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome.css') }}">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <script>
        function getParentUrl() {
            return (window.location != window.parent.location)
                ? document.referrer
                : document.location.href;
        }

        $(document).ready(function () {
            let iframeUrl = '{!! url('/') !!}',
                parentUrl = getParentUrl();

            //if iframe doesn't located on app domain
            if (parentUrl.includes(iframeUrl) === false && parentUrl) {
                $('.js-items-list a').each(function () {
                    let href = $(this).attr('href');

                    $(this).attr('href', href + '?referer=' + encodeURI(parentUrl));
                });
            }
        });
    </script>
</head>
<body class="@yield('body-class', '') embed">
    <div id="app">
        @yield('content')
    </div>

    <p class="text-center">
        <span class="d-block">Powered by</span>
        <a class="navbar-brand" href="{{ url('/') }}" target="_blank"><img src="{{ asset('images/neuly-logo-dark.png') }}" alt="Neuly"></a>
    </p>
</body>
</html>
