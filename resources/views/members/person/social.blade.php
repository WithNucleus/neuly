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

                        <form id="user-profile" action="{{ route('user.person.save.social') }}" method="post" class="needs-validation" novalidate>
                            @csrf

                            <div class="form-group row">
                                <div class="col-12 col-md-12 mb-3 mb-md-0">
                                    <label for="website" class="font-weight-bold">Website</label>
                                    <input type="text" class="form-control" name="website" value="{{ $person->website }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12 col-md-12 mb-3 mb-md-0">
                                    <label for="facebook" class="font-weight-bold">Facebook</label>
                                    <input type="text" class="form-control" name="facebook" value="{{ $person->facebook }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12 col-md-12 mb-3 mb-md-0">
                                    <label for="linkedin" class="font-weight-bold">LinkedIn</label>
                                    <input type="text" class="form-control" name="linkedin" value="{{ $person->linkedin }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12 col-md-12 mb-3 mb-md-0">
                                    <label for="google_scholar" class="font-weight-bold">Google Scholar</label>
                                    <input type="text" class="form-control" name="google_scholar" value="{{ $person->google_scholar }}" required>
                                </div>
                            </div>
                            <button type="submit" class="submit btn btn-primary">Save</button>
                        </form>
                    </div>

                </div>
            </div>
        </main>
    </div>

    @include('footers.mini')

@endsection
