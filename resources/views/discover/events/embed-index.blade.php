@extends('layouts.embed')

@section('body-class', 'page-jobs')

@section('content')
    <div class="container-fluid py-4">
        <main role="main">
            @include('discover.events.includes.items-list', ['embed' => true])
        </main>
    </div>
@endsection
