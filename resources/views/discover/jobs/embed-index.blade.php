@extends('layouts.embed')

@section('body-class', 'page-jobs bg-light')

@section('content')
    <div class="container py-4">
        <main role="main">
            @include('discover.jobs.includes.items-list', ['embed' => true])
        </main>
    </div>
@endsection
