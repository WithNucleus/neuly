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

        {{-- Sidebar and Content Area --}}
        <div class="row">
            <main id="index-main" role="main" class="col-lg-9 col-xl-10 ml-auto">

                <div class="row">
                    <div class="col-12">
                        <div class="full-width-show-view">

                            <div class="page-title-default d-md-flex justify-content-between">
                                <h1 class="mb-0 mr-5">Neuly {{ $title }} Embed Widget</h1>
                            </div>

                            <div class="row mt-4">
                                <div class="col-12 col-md-6">
                                    <iframe src="{{ $embedUrl }}" width="100%" height="100%" style="min-width: 480px; min-height: 480px"></iframe>
                                </div>
                                <div class="col-12 col-md-6">
                                    <p class="lead">
                                        @if($title === 'Events')
                                            Embed our free events widget to display upcoming events related to the psychedelics industry on your website.
                                        @elseif ($title === 'Jobs')
                                            Embed our free jobs widget to display job listings for the psychedelic industry on your website.
                                        @endif
                                    </p>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Embed widget code:</label>
                                        <textarea class="form-control" readonly><iframe src="{{ $embedUrl }}" width="100%" height="100%" style="min-width: 480px; min-height: 480px"></iframe></textarea>
                                        <p><small>Copy and paste to your webpage</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                @include('discover.includes.discover-footer-content')

            </main>

        </div>

    </div>

@endsection
