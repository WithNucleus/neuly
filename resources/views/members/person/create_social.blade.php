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
                    <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                </div>

                <div class="py-4 col-12 col-lg-12">

                    <div class="alert alert-danger errors alert-dismissible fade show" style="display:none">
                        <ul class="plain-list mb-0 font-small"></ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    @include('members.includes.status-messages')

                    <form id="user-profile" action="{{ route('user.person.finish.store') }}" method="post" class="needs-validation" novalidate>
                        @csrf
                        <div class="form-group row">
                            <div class="col-12 col-md-12 mb-3 mb-md-0">
                                <label for="website" class="font-weight-bold">Website</label>
                                <input type="text" class="form-control" name="website">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 col-md-12 mb-3 mb-md-0">
                                <label for="facebook" class="font-weight-bold">Facebook</label>
                                <input type="text" class="form-control" name="facebook">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 col-md-12 mb-3 mb-md-0">
                                <label for="linkedin" class="font-weight-bold">LinkedIn</label>
                                <input type="text" class="form-control" name="linkedin">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 col-md-12 mb-3 mb-md-0">
                                <label for="google_scholar" class="font-weight-bold">Google Scholar</label>
                                <input type="text" class="form-control" name="google_scholar">
                            </div>
                        </div>

                        <button type="submit" class="submit btn btn-primary">next</button>
                    </form>
                </div>

            </div>
    </div>
    </main>
    </div>

    @include('footers.mini')

@endsection
