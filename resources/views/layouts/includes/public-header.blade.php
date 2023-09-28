<!doctype html>
<html lang="en" data-bs-theme="auto">
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

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&family=Heebo:wght@800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="https://kit.fontawesome.com/88643155ec.js" crossorigin="anonymous"></script>

    @include('layouts.includes._favicons')

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-171437771-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-171437771-1');
    </script>

    @yield('head')

</head>

<body class="@yield('body-class', '') {{ auth()->check() === false ? 'unauthorized' : 'authorized' }}">
