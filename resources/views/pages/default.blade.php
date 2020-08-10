@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')

    @include('navbars.primary')

    <div class="container">
        <main id="content-main" role="main" class="col-12">
            <div class="row">
                <div class="col-12 col-xl-10 mx-auto bg-white p-4 shadow-sm">

                    <h1 class="page-title-default text-primary">{{ $page->title }}</h1>

                    {!! $page->content !!}

                </div>
            </div>

        </main>
    </div>

    @include('footers.mini')

@endsection