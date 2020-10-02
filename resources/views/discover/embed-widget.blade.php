<?php
$minheight = 1500;

if ($title === 'Events') {
    $minheight = 2700;
}
?>

@extends('layouts.app')

@section('body-class', 'page-jobs bg-light')

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
                        $title => $previousUrl,
                        'Embed Widget' => false,
                    ]
                ])
            </div>
        </div>
    </div>

    <main id="index-main" role="main">

        <div class="container">
            <h1>Neuly {{ $title }} Embed Widget</h1>
            <div class="bg-white p-3 shadow-sm">
                <div class="row mt-4">
                    <div class="col-12 col-md-6">
                        <div class="py-3 px-5">
                            @if($title === 'Events')
                                <img src="{{ asset('images/embed-events.png') }}" alt="Neuly Embed Widget" class="w-100">
                            @else
                                <img src="{{ asset('images/embed-jobs.png') }}" alt="Neuly Embed Widget" class="w-100">
                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <p class="lead mt-md-3">
                            @if($title === 'Events')
                                Embed our free events widget to display upcoming events related to the psychedelics industry on your website.
                            @elseif ($title === 'Jobs')
                                Embed our free jobs widget to display job listings for the psychedelic industry on your website.
                            @endif
                        </p>
                        <div class="form-group">
                            <label class="font-weight-bold">Embed widget code:</label>
                            <textarea class="form-control" readonly><iframe src="{{ $embedUrl }}" width="100%" height="100%" style="min-height: {{ $minheight }}px; border: 0;"></iframe></textarea>
                            <p><small>Copy and paste to your webpage</p>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-12">
                        <h2 class="lead-larger text-secondarydark mb-0 font-normal">Example:</h2>
                    </div>
                    <div class="col-12">
                        <iframe src="{{ $embedUrl }}" width="100%" height="100%" style="min-width: 480px; min-height: {{ $minheight }}px; border: 0;"></iframe>
                    </div>
                </div>
            </div>
        </div>

    </main>

@endsection
