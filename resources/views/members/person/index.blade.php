@extends('layouts.app')

@section('body-class', 'page-user-settings bg-light')

@section('content')

    @include('navbars.primary')

    <div class="container">
        <main id="content-main" role="main" class="col-12">
            <div class="row">
                <div class="col-12 col-xl-10 mx-auto bg-white p-4 shadow-sm">

                    <h1 class="page-title-default text-primary mb-4">Person Listing</h1>

                    @if( $person !== null)
                        @include('members.person.personal')
                    @elseif( count($claims) === 1)
                        @include('members.person.verify')
                    @else
                        @include('members.person.choose')
                    @endif
                </div>
            </div>
        </main>
    </div>

    @include('footers.mini')

@endsection
