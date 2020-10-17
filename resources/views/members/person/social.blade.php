@extends('layouts.app')

@section('body-class', 'page-user-settings bg-light')

@section('content')

    @include('navbars.primary')

    <div class="container">
        <main id="content-main" role="main" class="col-12">
            <div class="row">
                <div class="col-12 col-xl-10 mx-auto bg-white p-4 shadow-sm">

                    <h1 class="page-title-default text-primary mb-4">Person Listing</h1>

                    @include('navbars.tabs-user-person')

                    <div class="py-4 col-12 col-lg-12">

                        <div class="alert alert-danger errors alert-dismissible fade show" style="display:none">
                            <ul class="plain-list mb-0 font-small"></ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        @include('members.includes.status-messages')

                        <form id="user-profile" action="{{ route('user.settings') }}" method="post" class="needs-validation" novalidate>
                            @csrf

                            <button type="submit" class="submit btn btn-primary">Save</button>
                        </form>
                    </div>

                </div>
            </div>
        </main>
    </div>

    @include('footers.mini')

@endsection
