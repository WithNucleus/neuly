@extends('layouts.embed')

@section('body-class', 'page-jobs bg-light')

@section('content')
    <div class="container-fluid">
        <div class="row mt-2">

            @include('sidebars.primary', ['embed' => true])

            <main role="main" class="col-lg-9 col-xl-10 ml-auto">
                @include('discover.jobs.includes.items-list')
            </main>
        </div>
    </div>
@endsection
