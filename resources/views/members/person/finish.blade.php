@extends('layouts.app')

@section('body-class', 'page-user-settings bg-light')

@section('content')

    @include('navbars.primary')

    <div class="container">
        <main id="content-main" role="main" class="col-12">
            <div class="row">
                <div class="col-12 col-xl-10 mx-auto bg-white p-4 shadow-sm">

                    <h1 class="page-title-default text-primary mb-4">Create your person profile</h1>

                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                    <div class="py-4 col-12 col-lg-12">

                        <div class="alert alert-danger errors alert-dismissible fade show" style="display:none">
                            <ul class="plain-list mb-0 font-small"></ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        @include('members.includes.status-messages')

                        <div>
                            Your person profile was created successfully.
                        </div>
                        <br /><br />
                        <div>
                            <a href="{{ route('discover.people.show', ['slug' => $person->slug]) }}" class="btn btn-primary">visit person</a>
                            <a href="{{ route('member.dashboard') }}" class="btn btn-primary">go to dashboard</a>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>

    @include('footers.mini')

@endsection
