@extends('layouts.embed')

@section('body-class', 'page-jobs bg-light')

@section('content')
    <div class="container-fluid">
        <div class="row mt-2">

            @include('sidebars.primary')

            <main role="main" class="col-lg-9 col-xl-10 ml-auto">
                @include('discover.events.includes.items-list', ['embed' => true])
            </main>
        </div>
    </div>
@endsection
